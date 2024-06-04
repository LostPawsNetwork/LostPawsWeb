from fastapi import FastAPI, File, UploadFile
from fastapi.responses import JSONResponse
import torch
from transformers import pipeline, AutoModelForImageClassification, AutoFeatureExtractor
from PIL import Image
import io

app = FastAPI()

checkpoint_dir = 'results/checkpoint-1030'

model = AutoModelForImageClassification.from_pretrained(checkpoint_dir)
image_processor = AutoFeatureExtractor.from_pretrained(checkpoint_dir)

dog_breeds_multiclass_image_classifier = pipeline(
    "image-classification", 
    model=model.to(torch.device('cpu')), 
    feature_extractor=image_processor
)

@app.post("/classify/")
async def classify_image(file: UploadFile = File(...)):
    image = Image.open(io.BytesIO(await file.read()))
    
    result = dog_breeds_multiclass_image_classifier(image)
    
    return JSONResponse(content=result)

@app.get("/")
def read_root():
    return {"message": "API de clasificación de razas de perros"}

if __name__ == "__main__":
    import uvicorn
    uvicorn.run(app, host="0.0.0.0", port=8000)