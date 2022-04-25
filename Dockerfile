FROM ruby:3.0.4

RUN apt-get update && apt-get -y install node-less

WORKDIR /usr/src/app
COPY Gemfile /usr/src/app/Gemfile
COPY Gemfile.lock /usr/src/app/Gemfile.lock
RUN bundle install

COPY . /usr/src/app
RUN mkdir -pv /usr/src/app/tmp && bundle exec rake assets:compile --trace

EXPOSE 8000
CMD bundle exec puma --port 8000

HEALTHCHECK CMD curl http://localhost:8000/status || exit 1
