FROM python:3
EXPOSE 80
WORKDIR /app
COPY . /app
RUN pip install -r requirements.txt
CMD ["gunicorn", "--chdir", "/app/app",  "--workers", "5", "--bind", "0.0.0.0:80", "wsgi:app"]