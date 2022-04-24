#!/usr/bin/python3

import requests
import sys

def cmd_args(func):
    def wrapper():
        return func(sys.argv[1], sys.argv[2])

    return wrapper

@cmd_args
def run(ip=None, _id=None):
	response = requests.get(f"http://{ip}/test/upload/{_id}")
	return response.text

print(run())