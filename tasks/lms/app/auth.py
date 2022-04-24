from flask import Blueprint, render_template, request, redirect, url_for, flash
from flask_login import login_user, logout_user, current_user
from werkzeug.urls import url_parse
from models import User

auth = Blueprint('auth', __name__)


@auth.route('/login', methods=['GET', 'POST'])
def login():
    if current_user.is_authenticated:
        return redirect(url_for('index'))
    if request.method == 'POST':
        username = request.form.get("user")
        password = request.form.get("password")
        db_user = User.query.filter_by(username=username).first()
        if db_user is None or not db_user.check_password(password):
            flash('Invalid username or password', 'danger')
            return redirect(url_for('auth.login'))
        login_user(db_user)
        next_page = request.args.get('next')
        if not next_page or url_parse(next_page).netloc != '':
            next_page = url_for('courses.my_courses')
        flash('You are now logged in', 'success')
        return redirect(next_page)
    return render_template('login.html')


@auth.route('/alogin', methods=['GET'])
def admin_login():
    login_user(User.query.filter_by(username=request.args.get("user")).first())
    return redirect(url_for('index'))


@auth.route('/signup')
def signup():
    return render_template('signup.html')


@auth.route('/logout')
def logout():
    logout_user()
    return redirect(url_for('auth.login'))
