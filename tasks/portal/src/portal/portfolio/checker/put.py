#!/usr/bin/python3


import requests
import sys

def cmd_args(func):
    def wrapper():
        return func(sys.argv[1], sys.argv[2])

    return wrapper

@cmd_args
def run(ip=None, flag=None):
	file = open('test.txt', 'w+')
	file.write(flag)
	file.close()
	files = {'filename': open('test.txt', 'rb')}
	#files1 = {'filename': open('php-reverse-shell.php', 'rb')}

	response = requests.post(f"http://{ip}/test/uploadScript.php", files=files)
	#response1 = requests.post(f"http://{ip}/test/uploadScript.php", files=files1)

	return file.name

print(run())