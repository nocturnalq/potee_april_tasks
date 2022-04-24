import json
import random

import yaml
from werkzeug.security import generate_password_hash, check_password_hash
from flask_login import UserMixin, current_user
from database import db


class Access:
    admin = 0
    editor = 1
    student = 2


class User(UserMixin, db.Model):
    __tablename__ = 'users'
    id = db.Column(db.Integer, primary_key=True)
    username = db.Column(db.String(30))
    hash = db.Column(db.String(128))
    access = db.Column(db.Integer)
    register_date = db.Column(db.DateTime)
    users_courses = db.relationship("UsersCourses")

    def __init__(self, username, access=Access.student):
        self.id = ''
        self.username = username
        self.hash = ''
        self.access = access

    def is_admin(self):
        return self.access == Access.admin

    def is_student(self):
        return self.access == Access.student

    def allowed(self, access_level):
        return self.access >= access_level

    def set_password(self, password):
        self.hash = generate_password_hash(password)

    def check_password(self, password):
        return check_password_hash(self.hash, password)

    def __repr__(self):
        return f'<User {self.username}>'


class UsersCourses(db.Model):
    __tablename__ = 'users_courses'
    id = db.Column(db.Integer, primary_key=True)
    user_id = db.Column(db.Integer, db.ForeignKey('users.id'))
    course_id = db.Column(db.Integer, db.ForeignKey('courses.id'))
    last_question_id = db.Column(db.Integer)
    questions_data = db.Column(db.JSON)
    course_note = db.Column(db.String(100))
    register_date = db.Column(db.DateTime)
    course = db.relationship("Courses")

    def __init__(self, user_id, course_id, course_note=None, last_question_id=0):
        self.user_id = user_id
        self.course_id = course_id,
        self.last_question_id = last_question_id
        self.course_note = course_note
        self.course = Courses.query.get(course_id)
        self.load_questions()

    def load_questions(self):
        with open(f'../../questions/{self.course.questions}') as f:
            data = yaml.safe_load(f.read())
        questions = list()
        for question in data['questions']:
            variants: list = question['answers']
            random.shuffle(variants)
            right_id = random.randint(0, len(variants))
            variants.insert(right_id, question['answer'])

            questions.append({"question": question['question'],
                              "type": question['type'],
                              "variants": variants,
                              "right": right_id})
        self.questions_data = json.dumps({"questions": questions})


class Courses(db.Model):
    __tablename__ = 'courses'
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(100))
    slug = db.Column(db.String(100))
    questions = db.Column(db.String(100))
    created_date = db.Column(db.DateTime)

    def __init__(self):
        self.registered = False

    def check_registered(self):
        for course in current_user.users_courses:
            print(type(course.course_id))
            if course.course_id == self.id:
                print(self.id)
                return course.id, True
        return 0, False
