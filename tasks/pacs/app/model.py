import hashlib

import bson
from werkzeug.security import check_password_hash

class User():
    def __init__(self, id):
        self.id = id
        self.username = None
        self.password_hash = None

    def is_authenticated(self):
        return True

    def is_active(self):
        return True

    def is_anonymous(self):
        return False

    def get_id(self):
        return self.id

    def hash_password(self, password):
        salt = 'explabs'
        self.password_hash = hashlib.sha512((password + salt).encode()).hexdigest()
        print(self.password_hash)

    @staticmethod
    def validate_login(password_hash, password):
        return password_hash == password

    @staticmethod
    def build_user(user):
        userObj = User(str(user['_id']))
        userObj.username = user['login']
        userObj.password_hash = user['password']
        return userObj
