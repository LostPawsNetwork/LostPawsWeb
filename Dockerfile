FROM python:3.11-slim

WORKDIR /app

COPY requirements.txt .

RUN pip install --no-cache-dir -r requirements.txt

ENV SERVER_URL http://161.132.47.250:8082

RUN mkdir -p /app/checkpoint

RUN wget ${SERVER_URL}/pytorch_model.bin -O /app/results/checkpoint-1030/pytorch_model.bin
RUN wget ${SERVER_URL}/optimizer.pt -O /app/results/checkpoint-1030/optimizer.pt

COPY DogDetector/ .

EXPOSE 80

CMD ["uvicorn", "main:app", "--host", "0.0.0.0", "--port", "80"]
