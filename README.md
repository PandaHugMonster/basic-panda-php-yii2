# Simple Yii2 + SimpUtils foundation/template for quick apps building 

Version: 1.0.0

## Intro
This is a simple Staged Docker/Docker-Compose + PHP/Yii2 + PHP/SimpUtils template.

Despite it contains PHP/Yii2/SimpUtils, you can empty the `app` folder completely, and
place your app there (Just make sure the correct Docker Images are used in this case, and not
Yii2 ones).

## How to use

### Local development version

Get in the terminal into the code root dir.

Then to run with docker-compose `dev` version you simple need to run the following command:
```shell
docker compose -f docker/dev/docker-compose.yml -f docker/base/docker-compose-base.yml up -d
```
**Keep in mind the order of docker-compose files matter!**
P.S. if `docker compose` part does not work, try using `docker-compose` instead of that part.

Then just access: [http://localhost:8080](http://localhost:8080)

To stop (down/remove) run this command:
```shell
docker compose -f docker/dev/docker-compose.yml -f docker/base/docker-compose-base.yml down
```
