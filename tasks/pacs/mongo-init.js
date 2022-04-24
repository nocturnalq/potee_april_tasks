print('Start #################################################################');

db = db.getSiblingDB('db');
db.createUser(
    {
        user: 'admin',
        pwd: 'admin',
        roles: [{role: 'readWrite', db: 'db'}],
    },
);
db.createCollection('login');
db.login.insert([
    {
        login: "admin",
        password: "b0e460e3319c355e499ab2919bc62b699bc53ee8ec1c14b7e1b82f1abcdf4b3de79aca16e197ef7de107602ef68620f1e846977b4fcaf10c1d40dc82c4522cbd"
    },
    {
        login: "user",
        password: "e9ee61091528ffab4f9fef7a8bca95cbe2350a74c27fed73b40efc0c06add08a59266d9207bfec0c1d75d8ad7014de1ff365d9ae6d9059433c706ca716ecdb0b"
    }
])
db.devices.insert([
    {
        'name': "Front Door",
        'ip': "192.168.1.201",
        'role': "Employe"
    }
])
db.users.insert([
    {
        'firstname': "Ivan",
        'secondname': "Ivanov",
        'role': "Employe",
        'card': ["1234567890"],
        'gates': ["Front Door"]
    }
])

print('END #################################################################');