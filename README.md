# FastAPI Dog Breed Classifier

Esta es una aplicación FastAPI para clasificar razas de perros utilizando un modelo de clasificación de imágenes de Transformers.

## Requisitos

- Docker

## Construir la Imagen Docker

Para construir la imagen Docker de la aplicación, sigue estos pasos:

1. Asegúrate de que `Dockerfile` y `requirements.txt` estén en el mismo directorio que `main.py`.
2. Abre una terminal y navega al directorio donde se encuentra tu proyecto.
3. Ejecuta el siguiente comando para construir la imagen Docker:

    ```bash
    docker build -t fastapi-dog-breed-classifier .
    ```

## Ejecutar el Contenedor Docker

Una vez que la imagen Docker esté construida, puedes ejecutar el contenedor utilizando el siguiente comando:

```bash
docker run -p 8000:8000 fastapi-dog-breed-classifier
```