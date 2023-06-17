#!/usr/bin/python3

import subprocess
import argparse

parser = argparse.ArgumentParser()

parser.add_argument("action")
parser.add_argument("env")

args = parser.parse_args()

# Proto run
subprocess.run(
    "./protoc --proto_path=./protos --php_out=./protos ./protos/*.proto",
    shell=True,
    cwd=".",
)
subprocess.run(
    "rm -rf ./backend/app/Proto && mv ./protos/App/Proto ./backend/app",
    shell=True,
    cwd=".",
)


if args.action == "run":
    steps = [
        ("yarn build", "./frontend"),
        ("cp -r frontend/dist/* ./backend/public", "./"),
        ("php artisan serve", "./backend"),
    ]

    for s, cwd in steps:
        subprocess.run(s, shell=True, cwd=cwd)

elif args.action == "helper":
    steps = [('php artisan ide-helper:models --dir="app"', "./backend")]

    for s, cwd in steps:
        subprocess.run(s, shell=True, cwd=cwd)
else:
    pass
