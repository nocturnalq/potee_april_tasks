FROM python:3.8-alpine
WORKDIR /app
COPY requirements.txt .
COPY app /app
RUN pip3 install -r requirements.txt
CMD ["python3","/app/server.py"]