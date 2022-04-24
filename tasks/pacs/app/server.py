import datetime
import hashlib
import json

import bson
from flask import Flask, jsonify, render_template, request, redirect, url_for, session, g
from pymongo import MongoClient
import os
from flask_login import LoginManager
from flask_login import login_user, logout_user, login_required, current_user
from model import User

app = Flask(__name__)
app.secret_key = "YOUR-SECRET-KEY"
app.config['UPLOAD_FOLDER'] = 'photos'
mongo = MongoClient('mongodb', 27017)
login_manager = LoginManager()
login_manager.init_app(app)
login_manager.login_view = 'login'


@app.route('/', methods=['GET', 'POST'])
@login_required
def index():
    if request.method == 'POST':
        for user in request.form:
            delete_user(user)
    users = mongo.db.users.find()
    return render_template('index.html', users=users)


@app.route('/logs')
@login_required
def logs():
    logs = mongo.db.logs
    users = mongo.db.users
    # logs.delete_many({})
    loglist = logs.find().sort([('date', -1)]).limit(20)
    output_users = []
    output_access = []
    for row in loglist:

        if type(row['user']) is not dict:
            user = users.find_one({'_id': bson.ObjectId(oid=str(row['user']))})
            if user:
                user['card'] = user['card'][0]
            if 'user' in row['action']:
                output_users.append({'action': row['action'], 'user': user, 'date': row['date']})
            else:
                output_access.append({'action': row['action'], 'gate': row['gate'], 'user': user, 'date': row['date']})
        else:
            if 'user' in row['action']:
                output_users.append(row)
            else:
                output_access.append(row)
    return render_template('logs.html', logs_users=output_users, logs_access=output_access)


@app.route('/add_user', methods=['GET', 'POST'])
@login_required
def add_user():
    devices = mongo.db.devices.find()
    if request.method == 'POST':
        firstname = request.form.get('name')
        secondname = request.form.get('secondname')
        role = request.form.get('role')
        card = request.form.getlist('card[]')
        gates = request.form.getlist('gate')
        print(firstname, secondname, role, card, gates)
        # todo: check input
        users = mongo.db.users
        _id = users.insert_one({'firstname': firstname,
                                'secondname': secondname,
                                'role': role,
                                'card': card,
                                'gates': gates})
        if request.files:
            image = request.files["image"]
            filename = '%s.png' % _id.inserted_id
            image.save(os.path.join(app.config['UPLOAD_FOLDER'], filename))
        logs = mongo.db.logs
        logs.insert_one(
            {'action': 'Add user', 'user': bson.ObjectId(oid=str(_id.inserted_id)), "date": datetime.datetime.now()})
        return redirect(url_for('index'))
    return render_template('add_user.html', gates=devices)


@app.route('/rm_user/<_id>')
@login_required
def rm_user(_id):
    delete_user(_id)
    return redirect(url_for('index'))


def delete_user(_id):
    logs = mongo.db.logs
    users = mongo.db.users
    user = users.find_one({'_id': bson.ObjectId(oid=str(_id))})
    logs.insert_one({'action': 'Remove user', 'user': {'secondname': user['secondname'],
                                                       'firstname': user['firstname'],
                                                       'card': user['card']}, "date": datetime.datetime.now()})
    users.delete_one({'_id': bson.ObjectId(oid=str(_id))})


@app.route('/change_user/<_id>', methods=['GET', 'POST'])
@login_required
def change_user(_id):
    users = mongo.db.users
    devices = mongo.db.devices.find()
    if request.method == 'POST':
        firstname = request.form.get('name')
        secondname = request.form.get('secondname')
        role = request.form.get('role')
        card = request.form.getlist('card[]')
        gates = request.form.getlist('gate')
        # todo: check input
        users.update_one({'_id': bson.ObjectId(oid=str(_id))},
                         {'$set': {'firstname': firstname,
                                   'secondname': secondname,
                                   'role': role,
                                   'card': card,
                                   'gates': gates}})
        if request.files:
            image = request.files["image"]
            filename = '%s.png' % _id
            image.save(os.path.join(app.config['UPLOAD_FOLDER'], filename))
        return redirect(url_for('index'))

    user = users.find_one({'_id': bson.ObjectId(oid=str(_id))})
    return render_template('user_info.html', user=user, gates=devices)


@app.route('/list_users')
@login_required
def list_users():
    users = mongo.db.users
    output = []
    for user in users.find():
        output.append({'firstname': user['firstname'], 'secondname': user['firstname'], 'role': user['role']})
    return jsonify({'status': 'ok', 'result': output})


@login_manager.user_loader
def load_user(user_id):
    user = mongo.db.login.find_one({"_id": bson.ObjectId(oid=str(user_id))})
    return User.build_user(user)


@app.before_request
def before_request():
    g.user = current_user


@app.route('/login', methods=['GET', 'POST'])
def login():
    response = {
        "success": False,
        "response": " "
    }
    if request.method == 'POST':
        username = request.form.get('login')
        password = request.form.get('password')
        salt = 'explabs'
        password_hash = hashlib.sha512((password + salt).encode()).hexdigest()
        if username and password:
            login = mongo.db.login
            user = login.find_one({"login": username})
            if user and User.validate_login(user["password"], password_hash):
                user_obj = User.build_user(user)
                if login_user(user_obj):
                    userSession = {
                        'userId': user['_id'],
                        'session_id': session["_id"],
                        'success': True
                    }
                    mongo.db.session.insert_one(userSession)
                    mongo.db.session.update_one({
                        "userId": bson.ObjectId(user['_id'])
                    },
                        {
                            "$set": {
                                "session_id": session['_id']
                            }
                        }, upsert=True)
                    return redirect(url_for('index'))
            else:
                response["response"] = "Worng password"
                return render_template('login.html', response=response)
        else:
            response["response"] = "Username or password not entered"
            return render_template('login.html', response=response)
    return render_template('login.html')


@app.route('/logout')
def logout():
    logout_user()
    return redirect(url_for('login'))


@app.route('/register')
def register():
    return render_template('register.html')


@app.route('/add_device', methods=['GET', 'POST'])
@login_required
def add_device():
    devices = mongo.db.devices
    if request.method == 'POST':
        name = request.form.get('name')
        ip = request.form.get('ip')
        role = request.form.get('role')
        if ip is not None:
            if name is not None:
                devices.insert_one({'name': name, 'ip': ip, 'role': role})
    return render_template('add_device.html')


@app.route('/change_device/<_id>', methods=['GET', 'POST'])
@login_required
def change_device(_id):
    devices = mongo.db.devices
    if request.method == 'POST':
        name = request.form.get('name')
        ip = request.form.get('ip')
        role = request.form.get('role')
        if ip is not None:
            if name is not None:
                devices.update_one({'_id': bson.ObjectId(oid=str(_id))},
                                   {'$set': {'name': name,
                                             'ip': ip,
                                             'role': role, }})
                return redirect(url_for('device_list'))
    device = devices.find_one({'_id': bson.ObjectId(oid=str(_id))})
    return render_template('change_device.html', device=device)


@app.route('/device_list')
@login_required
def device_list():
    devices = mongo.db.devices.find()
    return render_template('device_list.html', devices=devices)


def update_state(is_open: bool):
    mongo.db.devices.update_one({'ip': request.remote_addr},
                                {'$set': {'is_open': is_open}})


@app.route('/device_status')
def device_status():
    state = request.args.get("is_open")
    if state is not None:
        state = bool(int(state))
        print(state)
        update_state(state)
    return jsonify([doc for doc in mongo.db.devices.find({}, {"_id": 0})])


@app.route('/check', methods=['POST'])
def check():
    if request.method == 'POST':
        data = request.get_json()
        if data:
            rfid = data.get('rfid', None)
            user = mongo.db.users.find_one({"$where": "this.card == '" + rfid + "'"})
            if user is not None:
                return 'accept'
            return 'denied user'
        return 'denied data'
    return 'denied'


if __name__ == '__main__':
    app.run(host='0.0.0.0', debug=True)
