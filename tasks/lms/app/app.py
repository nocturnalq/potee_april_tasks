from flask import Flask, redirect, url_for
from flask_login import LoginManager, current_user
from models import User


def create_app():
    app = Flask(__name__)

    app.config['SECRET_KEY'] = 'secret-key-goes-here'
    app.config["SQLALCHEMY_DATABASE_URI"] = "mariadb+pymysql://admin:admin@lms-mariadb:3306/lms"

    from database import db
    db.init_app(app)

    login_manager = LoginManager()
    login_manager.login_view = 'auth.login'
    login_manager.init_app(app)

    @login_manager.user_loader
    def load_user(_id):
        return User.query.get(_id)  # if this changes to a string, remove int

    # blueprint for auth routes in our app
    from auth import auth as auth_blueprint
    app.register_blueprint(auth_blueprint)

    # blueprint for non-auth parts of app
    from exam import main as main_blueprint
    app.register_blueprint(main_blueprint)

    from courses import courses as courses_blueprint
    app.register_blueprint(courses_blueprint)

    from admin import admin as admin_blueprint
    app.register_blueprint(admin_blueprint)

    @app.route("/")
    def index():
        if current_user.is_authenticated:
            return redirect(url_for('courses.index'))
        return redirect(url_for('auth.login'))

    return app


if __name__ == '__main__':
    app = create_app()
    app.run(debug=False)
