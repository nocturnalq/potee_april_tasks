import math
import random
import yaml
from flask import Blueprint, request, render_template, redirect, url_for, request
from flask_login import login_required, current_user
from models import Courses, UsersCourses
from database import db

courses = Blueprint('courses', __name__, url_prefix="/course")


@courses.route("/")
@courses.route("/<int:page>")
@login_required
def index(page=1):
    per_page = 10
    db_courses = Courses.query.order_by(Courses.created_date).paginate(page, per_page, error_out=False)
    total_pages = math.ceil(db_courses.total / per_page)
    return render_template('courses.html', courses=db_courses.items, total_pages=total_pages, current_page=page)


@courses.route("/my")
@courses.route("/my/<int:page>")
@login_required
def my_courses(page=1):
    per_page = 10
    window_end = page * per_page
    window_start = window_end - per_page
    my_courses_list = list()
    all_my_courses = current_user.users_courses
    total_pages = math.ceil(len(all_my_courses) / per_page)
    for i, course in enumerate(all_my_courses):
        if window_start <= i <= window_end:
            my_courses_list.append(course.course)
    print(my_courses_list)
    return render_template('courses.html', courses=my_courses_list,
                           total_pages=total_pages, current_page=page)


def add_course_for_user(course_id, note):
    new_course = Courses.query.get(course_id)
    if new_course:
        new_users_course = UsersCourses(current_user.id, new_course.id, note)
        db.session.add(new_users_course)
        db.session.commit()
        return new_users_course.id


@courses.route("/add/<int:_id>")
@login_required
def add_course(_id):
    note = request.args.get("note")
    add_course_for_user(_id, note)
    return redirect(url_for('courses.index'))


@courses.route("/remove/<int:_id>")
@login_required
def remove_course(_id):
    deleted_course = UsersCourses.query.get(_id)
    db.session.delete(deleted_course)
    db.session.commit()
    return redirect(url_for('courses.index'))


@courses.route("/begin/<int:_id>")
@login_required
def begin_course(_id):
    note = request.args.get("note")
    course_id = add_course_for_user(_id, note)
    if course_id:
        return redirect(url_for('challenge.index', _id=course_id))
    return redirect(url_for('courses.index'))
