import json
from flask import Blueprint, request, render_template
from flask_login import login_required, current_user
from models import UsersCourses
from database import db

main = Blueprint('challenge', __name__, url_prefix="/test")


class Challenge:
    def __init__(self, users_course: UsersCourses):
        self.users_course = users_course
        self.note = users_course.course_note
        self.questions = json.loads(users_course.questions_data).get('questions')

    def get_question(self):
        return self.questions[self.users_course.last_question_id]

    def check_answer(self, answer):
        question_id = self.users_course.last_question_id
        if len(self.questions) - 1 <= question_id:
            # infinite loop of questions
            self.users_course.last_question_id = -1
        self.users_course.last_question_id += 1
        db.session.commit()
        if self.questions[question_id]['type'] == 'single':
            if self.questions[question_id]['right'] == answer:
                return True
        return False

    def get_previous_right_question_and_answer(self):
        question_id = self.users_course.last_question_id - 1
        if question_id == -1:
            question_id = len(self.questions) - 1
        question = self.questions[question_id]['question']
        right_answer_id = self.questions[question_id]["right"]
        answer = self.questions[question_id]["variants"][right_answer_id]
        return question, answer

    def render_error(self, error, value):
        string = "<p>{error}</p>".format(error=error)
        string += "<br><h4>invalid value: {value}</h4>"
        return string.format(self=self, value=value)


@main.route("/<path:_id>", methods=['GET', 'POST'])
@login_required
def index(_id):
    # IDOR
    challenge = Challenge(UsersCourses.query.get(_id))
    if request.method == 'POST':
        variant = request.form.get('variants')
        try:
            answer_id = int(variant) - 1
        except ValueError as v:
            return challenge.render_error(v.__str__(), variant)
        correct = challenge.check_answer(answer_id)
        question, answer = challenge.get_previous_right_question_and_answer()
        return render_template('test.html', data=challenge.get_question(),
                               correct=correct, question=question,
                               answer=answer, note=challenge.note)
    return render_template('test.html', data=challenge.get_question(), note=challenge.note, correct=None)
