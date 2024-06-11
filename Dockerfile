FROM debian:latest as downloader

RUN apt-get update && apt-get install -y wget

ENV SERVER_URL http://161.132.47.250:8082

RUN mkdir -p /checkpoint

RUN wget ${SERVER_URL}/pytorch_model.bin -O /checkpoint/pytorch_model.bin
RUN wget ${SERVER_URL}/optimizer.pt -O /checkpoint/optimizer.pt

FROM python:3.11-slim

WORKDIR /app

COPY requirements.txt .

RUN pip install --no-cache-dir -r requirements.txt

COPY --from=downloader /checkpoint /app/results/checkpoint-1030

COPY DogDetector/ .

EXPOSE 80

ENV PORT 80

CMD ["uvicorn", "main:app", "--host", "0.0.0.0", "--port", "80"]
