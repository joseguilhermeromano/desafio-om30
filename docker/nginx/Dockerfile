FROM nginx:1.19.6

COPY ./nginx.conf /etc/nginx/nginx.conf

COPY ./sites /etc/nginx/sites-available/

RUN mkdir /etc/nginx/sites-enabled/

RUN ln -s /etc/nginx/sites-available/frontend.conf /etc/nginx/sites-enabled/
RUN ln -s /etc/nginx/sites-available/backend.conf /etc/nginx/sites-enabled/