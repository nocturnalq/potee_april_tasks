import hashlib
# from pymongo import MongoClient
#
#
# def create_user():
#     salt = 'explabs'
#     client = MongoClient('mongodb', 27017)
#     db = client.db.login
#     password = 'explabs'
#     hashed_password = hashlib.sha512((password + salt).encode()).hexdigest()
#     id = db.insert_one({'login': 'admin', 'password': hashed_password})
#     print(id)
#     for logins in db.find():
#         print(logins)


def hash_pass(password):
    salt = 'explabs'
    return hashlib.sha512((password + salt).encode()).hexdigest()


if __name__ == '__main__':
    print(hash_pass(input("Enter password: ")))
