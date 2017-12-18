#### RUN `./install-once.sh` !!!
# example_project

## Deploy

`./deploy [-e local|dev|prod|test]`

Environment is local by default.

Your project will be available at [http://localhost:12421](http://localhost:12421)

## Run tests

`./tests [dev-mode]`
"dev-mode" recreates test containers and drops it after execution.

## Configuring XDebug for PHPStorm

- Open `Settings -> Languages & Frameworks -> PHP -> Servers`
- Click `+`
- Enter params:
    - Name: nginx
    - Host: nginx
    - Port: 80
    - Debugger: XDebug
    - Use path mapping: yes
    - Set path mapping `@project/app` to `/www`, where `@project` - your project directory
    - Save
- Click "Start listening for PHP Debug connections" 
- Enjoy!

#### You able to debug tests too.
