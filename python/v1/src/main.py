import os
import cv2
import sys
import json
import shutil
import face_recognition
import logging
import requests
from dotenv import load_dotenv


env_file_path = "../../../.env"
load_dotenv(env_file_path)
url = os.getenv("APP_URL")
laravel_url = url + "/api/search/image"
logging.basicConfig(filename='search.log', level=logging.INFO, format='%(asctime)s - %(levelname)s - %(message)s')

def load_images_from_folder(folder_path):
    images = []
    for root, _, files in os.walk(folder_path):
        if "/search" in root:
            continue
        if "/profile-photos" in root:
            continue
        for filename in files:
            if filename.endswith(('.jpg', '.jpeg', '.png')):
                img_path = os.path.join(root, filename)
                try:
                    image = face_recognition.load_image_file(img_path)
                    images.append((img_path, image))
                    logging.info(f"Loaded image: {img_path}")
                except Exception as e:
                    logging.error(f"Error loading image {img_path}: {str(e)}")
    return images

def detect_faces_in_image(input_image_path, storage_path, uuid):
    input_image_faces = face_recognition.face_encodings(face_recognition.load_image_file(input_image_path))
    images = load_images_from_folder(storage_path)
    result = {
        "data": {
            "uuid": uuid,
            "pin":  os.getenv("FACE_SEARCH_PIN"),
            "status": "pending",
            "input": input_image_path.replace("../", " ").strip(),
            "search_percentage": 0,
            "matches": [],
        }
    }
    matched_folder = "../../public/search/"+uuid
    os.makedirs(matched_folder, exist_ok=True)
    total_images = len(images)
    images_processed = 0
    for img_path, img in images:
        img_faces = face_recognition.face_encodings(img)
        images_processed +=1
        for img_face in img_faces:
            matches = face_recognition.compare_faces(input_image_faces, img_face)
            
            if any(matches):
                match_percentage = face_recognition.face_distance(input_image_faces, img_face)
                match_percentage = (1 - match_percentage[0]) * 100

                matched_image_name = os.path.basename(img_path)
                matched_image_destination = os.path.join(matched_folder, matched_image_name)
                shutil.copy(img_path, matched_image_destination)

                modified_copied_image_path = os.path.relpath(matched_image_destination, start="search")
                modified_copied_image_path = modified_copied_image_path.replace("public/", "").strip()
                result["data"]["matches"].append({
                    "searched_path": modified_copied_image_path.replace("../", " ").strip(),
                    "match_percentage": match_percentage,
                })

                copied_image = cv2.imread(matched_image_destination)
                for face_location in face_recognition.face_locations(copied_image):
                    top, right, bottom, left = face_location
                    cv2.rectangle(copied_image, (left, top), (right, bottom), (0, 255, 0), 2)
                    text = f"Match: {match_percentage:.2f}%"
                    cv2.putText(copied_image, text, (left, top - 10), cv2.FONT_HERSHEY_SIMPLEX, 0.6, (0, 255, 0), 2)
                cv2.imwrite(matched_image_destination, copied_image)
                result["data"]["search_percentage"] = (images_processed / total_images) * 100
                requests.post(laravel_url, json=result)
                break

    result["data"]["status"] = "success"
    result["data"]["search_percentage"] = 100
    requests.post(laravel_url, json=result)

if __name__ == "__main__":
    if len(sys.argv) != 3:
        logging.error("Invalid number of arguments. Expected 2 arguments: input_image_path and uuid.")
        sys.exit(1)

    input_image_path = sys.argv[1]
    uuid = sys.argv[2]
    img_folder_path = "../../storage/app/public/"

    logging.info(f"Starting face detection for input image: {input_image_path} with UUID: {uuid}")
    
    try:
        detect_faces_in_image(input_image_path, img_folder_path, uuid)
        logging.info("Face detection and matching completed successfully.")
    except Exception as e:
        logging.error(f"An error occurred during face detection: {str(e)}")