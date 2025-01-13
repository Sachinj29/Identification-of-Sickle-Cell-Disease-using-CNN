# **Identification of Sickle Cell Disease Using Deep Learning**

## **Overview**
This project focuses on developing a deep learning-based system to identify Sickle Cell Disease (SCD) from microscopic images of red blood cells. By leveraging Convolutional Neural Networks (CNN) and advanced models like MobileNet and Support Vector Machine (SVM) classifiers, the system aims to provide accurate and efficient classification, aiding in early detection and diagnosis of SCD.

---

## **Features**
- **Automated Detection**: Identifies sickle cells from microscopic images with high accuracy.
- **Robust Classification**: Combines MobileNet for feature extraction and SVM for classification.
- **Custom Dataset Support**: Trained and tested on a custom dataset of red blood cell images.
- **Scalable Design**: Easily extendable for other medical imaging tasks.

---

## **Technologies Used**
- **Deep Learning Models**:
  - MobileNet
  - Convolutional Neural Networks (CNN)
  - Support Vector Machine (SVM)
- **Libraries and Tools**:
  - TensorFlow
  - Keras
  - OpenCV
  - NumPy
  - Scikit-learn
- **Programming Language**: Python

---

## **Dataset**
- **Source**: Custom dataset containing labeled microscopic images of red blood cells.

---

- **Preprocessing**:
- Image resizing to fit the MobileNet input size.
- Data augmentation techniques such as rotation, flipping, and zooming to enhance diversity.

---

## **Project Workflow**
1. **Data Collection**
 - Gathered microscopic images of red blood cells, labeled as "healthy" or "sickle."

2. **Data Preprocessing**
 - Applied image resizing, normalization, and augmentation.

3. **Model Development**
 - Used MobileNet as a feature extractor.
 - Integrated SVM for final classification.

4. **Training**
 - Trained the model using the processed dataset with early stopping to prevent overfitting.

5. **Evaluation**
 - Evaluated the model on unseen test data to measure accuracy and generalization.

6. **Deployment**
 - Packaged the trained model for integration into desktop applications.

---


