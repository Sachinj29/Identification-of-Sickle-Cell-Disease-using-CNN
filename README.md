# 🧬 Identification of Sickle Cell Disease Using Deep Learning

> A deep learning-based medical imaging solution that identifies **Sickle Cell Disease (SCD)** from microscopic red blood cell images using **MobileNet** and **SVM**, helping in accurate and early diagnosis.

---

## 📌 Overview

This project focuses on developing an intelligent system that classifies red blood cells as **healthy** or **sickle-shaped** using modern computer vision and deep learning techniques. By leveraging **Convolutional Neural Networks (CNNs)** and the lightweight **MobileNet** architecture combined with **Support Vector Machines (SVM)**, the model achieves high classification accuracy while being resource-efficient.

---

## ✨ Features

- 🧠 **Automated Detection**  
  Detects sickle cells in microscope images using deep learning.

- 🧬 **Hybrid Model Architecture**  
  Uses **MobileNet** for feature extraction and **SVM** for robust classification.

- 🖼️ **Custom Dataset Support**  
  Built on a labeled dataset of real red blood cell images.

- 🔁 **Scalable & Modular**  
  Easily adaptable to other disease classification tasks.

---

## 🧰 Technologies Used

| Category         | Tools & Libraries                |
|------------------|----------------------------------|
| Deep Learning    | MobileNet, CNN, SVM              |
| Libraries        | TensorFlow, Keras, NumPy, OpenCV |
| ML Evaluation    | Scikit-learn                     |
| Language         | Python                           |

---

## 📊 Dataset

- **Source**: Custom dataset of microscope images.
- **Classes**:  
  - `Healthy` red blood cells  
  - `Sickle` (abnormal) red blood cells

---

### 🔧 Preprocessing Steps

- ✅ Resized images to `224x224` (MobileNet input format)  
- ✅ Applied **data augmentation**:
  - Random rotations
  - Flipping
  - Zooming  
- ✅ Normalized pixel values for optimal model performance

---

## 🔄 Project Workflow

### 1. 🗂️ Data Collection  
Gathered a dataset of labeled microscopic images of red blood cells.

### 2. 🧹 Data Preprocessing  
Resized, normalized, and augmented data to increase training robustness.

### 3. 🏗️ Model Development  
- Used **MobileNet** as a pretrained feature extractor (transfer learning)  
- Extracted features were passed to a **Support Vector Machine (SVM)** for classification

### 4. 🧪 Training  
- Trained with **early stopping** to prevent overfitting  
- Used **validation split** to monitor performance during training

### 5. 📈 Evaluation  
- Tested on unseen data  
- Evaluated accuracy, precision, recall, and F1-score

### 6. 🚀 Deployment  
- Exported the trained model  
- Prepared for integration into GUI or desktop diagnostic applications

---

