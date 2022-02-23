# POST
localhost:8000


localhost:8000/login_controller
- Request
    email       = andres@gmail.com;
    password    = andresc;
    login_type  = log_in;

- Response
    true
    false


localhost:8000/login_controller
- Request
    login_type  = session_exists;

- Response
    true
    false


localhost:8000/login_controller
- Request
    login_type  = close_session;
    
- Response
    true
    false


