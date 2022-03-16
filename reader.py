import numpy as np
import cv2 
import os

from pyzbar.pyzbar import decode

#img = cv2.imread('qr.png')
#code=decode(img)
#print(code)
#os.system("pause")

cap = cv2.VideoCapture(0)
cap.set(3,640)
cap.set(4,480)

while True:
    succes, img = cap.read()
    for barcode in decode(img):
        print(barcode.data)
        myData = barcode.data.decode('utf-8')
        print(myData)
    
    cv2.imshow('Result',img)
    cv2.waitkey(1)



