from flask import Blueprint, jsonify
from models import User

admin = Blueprint('admin', __name__, url_prefix="/admin")


def user_data(user: User):
    return {
        "user": user.username,
        "access": user.access,
        "register_at": user.register_date,
        "hash": user.hash,
    }


@admin.route("/users")
def user_list():
    users = User.query.all()
    return jsonify(list(map(user_data, users)))
