# Simple Yii2 + SimpUtils foundation/template for quick apps building 

Version: 2.0.0

## Intro
This is a simple Staged Docker/Docker-Compose + PHP/Yii2 + PHP/SimpUtils template.

Despite it contains PHP/Yii2/SimpUtils, you can empty the `app` folder completely, and
place your app there (Just make sure the correct Docker Images are used in this case, and not
Yii2 ones).

## How to use

The new structure and approach is used for the release `2.0.0` of this template.

> [!IMPORTANT]
> If you are up to using "yii2" default installation, make sure you regenerate (at least on production)
> `cookieValidationKey` value in `app/config/web.php`,
> otherwise you might have security issues with your project

> [!NOTE]
> The new version of this template utilizes `extends` and `profiles` functionality of `docker compose`.
> * [Docker Compose: extends](https://docs.docker.com/compose/multiple-compose-files/extends/)
> * [Docker Compose: profiles](https://docs.docker.com/compose/profiles/)

To run locally:

```shell
docker compose --profile dev up
```


> [!NOTE]
> Out of the box available profiles/stages:
> * `dev`
>   ```shell
>     docker compose --profile dev up
>   ```
> * `demo`
>   ```shell
>     docker compose --profile demo up
>   ```
> * `prod`
>   ```shell
>     docker compose --profile prod up
>   ```

P.S. if `docker compose` part does not work, try using `docker-compose` instead of that part.

Then just access: [http://localhost:8080](http://localhost:8080)

To stop (down/remove) run this command:
```shell
docker compose --profile dev down
```

## Structure and convenience

The structure of this template suppose to represent "Inheriting and Hierarchical" mindset.

1. `docker/Dockerfile` (Multi-stage):
  * `base-build` - shared foundation between the following stages
    * `dev` - Development stage, copies just a few things, 
      everything else suppose to be mounted through `docker compose` (perfect for local development)
    * `demo` - Demonstration/Preview stage, copies the whole code base into the image 
      to deploy for demo/preview purposes
    * `prod` - Production stage, copies the whole code base into the image to deploy
2. Docker compose
   * `docker-compose.yml` in the code base root folder is the entry-point,
     and includes all the underlying `docker-compose.yml`.
     If you need custom stages/structures - make sure you include those custom `docker-compose.yml`
     into the entry-point `docker-compose.yml`.
     * `docker/base/docker-compose-base.yml` - Used as a parent for `dev`, `demo` and `prod` docker compose files
       * `docker/dev/docker-compose.yml` - Inherits most of the stuff from `base` and 
         defines/redefines things for `dev` stage.
         Uses `dev` stage of `docker/Dockerfile`.
       * `docker/demo/docker-compose.yml` - Inherits most of the stuff from `base` and 
         defines/redefines things for `demo` stage.
         Uses `demo` stage of `docker/Dockerfile`.
       * `docker/prod/docker-compose.yml` - Inherits most of the stuff from `base` and 
         defines/redefines things for `prod` stage.
         Uses `prod` stage of `docker/Dockerfile`.
     * Despite that each service must have unique name even when `extends` used, network host names are
       aliased to use universal names for services
     * When modifying - make sure you assign proper `profiles` to the services, and make sure you specify unique 
       names for your inherited services, otherwise they might be redefined accidentally.
3. Env-Vars files:
   * `.env` in the stage folders are applied automatically by docker to their respective `docker-compose.yml`
   * `in-container-*.env` are applied to their respective services, and they suppose to redefine env-files
     from `base` folder. So if you need shared variable between every stage, you can define 
     it in `docker/base/in-container-*.env`.


## What is available out of the box

> [!NOTE]
> "Redis" was replaced with the `valkey` due to dubious and even disturbing decision of "Redis Labs"
> on changing license to a restrictive one, despite a lot of effort of Open Source community invested
> into their project. Which is equivalent of stealing. So use of "redis" is highly discouraged by developer
> of this template.

1. Basic Yii2 template with partially adjusted config
   * Some `ActiveRecord`s already include SimpUtils traits https://github.com/PandaHugMonster/php-simputils
2. Database of postgres `type` is set up
   * Make sure you change `password` and `user` values at least for `prod`
   * > [!IMPORTANT]
     > For `demo` and especially `prod` do not use Env Vars for passwords and secrets.
     > You can use `docker secret` https://docs.docker.com/engine/swarm/secrets/
3. Sessions and cache already set to use `valkey` 
   (open-source and compatible solution instead of "redis") https://valkey.io/
4. Dockerfile contains 2 stages: `dev` and `prod`
   * `prod` copies content of the code-base
   * `demo` copies content of the code-base
   * `dev` does not copy the full content of the code base, because it is being attached during docker-compose deploy
5. 
