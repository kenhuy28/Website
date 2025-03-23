import sys
import tensorflow as tf
import numpy as np
from PIL import Image

# Load model

model = tf.keras.models.load_model("C:/mohinh/mobilenet_model.h5")


def classify(image_path):
    # Load và tiền xử lý ảnh
    img = Image.open(image_path).resize((128, 128))
    img = np.array(img) / 255.0
    img = img[np.newaxis, ...]  # Thêm trục batch
    
    # Predict
    predictions = model.predict(img)
    class_idx = np.argmax(predictions)
    return class_idx

if __name__ == "__main__":
    image_path = sys.argv[1]
    result = classify(image_path)
    print(result)
