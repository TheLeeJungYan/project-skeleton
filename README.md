# Project Skeleton

This repository contains the project skeleton which is run with Docker.

## System Requirements

- Docker ^4.x
- Default ports [8100 (app) and 3400 (DB)] must be available, otherwise, it needs adjustment on the exposed ports.

## Setup

- Copy environment files by running `cp .env.example .env`.
- Run `docker-compose up -d`.
- If there are no issues, your app should run `http://localhost:8100`.
- Your database should run on port `3400`. Here are the default credentials:

```
HOST=localhost
PORT=3400
USERNAME=root
PASSWORD=aypgroup
```
