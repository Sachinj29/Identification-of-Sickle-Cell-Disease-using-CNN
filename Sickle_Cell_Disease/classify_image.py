import sys
import numpy as np
import warnings
warnings.filterwarnings("ignore")

import os

# Set TF_CPP_MIN_LOG_LEVEL to suppress TensorFlow warnings
os.environ['TF_CPP_MIN_LOG_LEVEL'] = '3'
from tensorflow.keras.models import load_model
from tensorflow.keras.preprocessing import image
from tensorflow.keras.applications.mobilenet import preprocess_input, decode_predictions

def classify_image(image_path):
    # Load the saved CNN model
    model = load_model('anemia_detection_model.h5')

    # Load and preprocess the image
    img = image.load_img(image_path, target_size=(224, 224))
    img_array = image.img_to_array(img)/255.0
    img_array = np.expand_dims(img_array, axis=0)

    # Perform prediction
    predictions = model.predict(img_array,verbose = 0)
    predicted_class_index = np.argmax(predictions)
    class_labels = ['Microcytic', 'Macrocytic', 'Dimorphic']
    predicted_class_label = class_labels[predicted_class_index] + ' Anemia'
    return predicted_class_label

if __name__ == '__main__':
    # Get image file path from command line argument
    image_path = sys.argv[1]
    # Perform image classification
    predictions = classify_image(image_path)
    # Print predictions (you can modify this part as needed)
    print(predictions)
