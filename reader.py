import numpy as np
import cv2 
import os

from pyzbar.pyzbar import decode

cap = cv2.VideoCapture(0)
cap.set(3,640)
cap.set(4,480)
camera = True

while camera == True:
    succes, img = cap.read()
    for code in decode(img):
        myData = code.data.decode('utf-8')
        print(myData)

    cv2.imshow('Result',img)
    if cv2.waitKey(1) == ord('q'):
        break

cap.release()
cv2.destroyAllWindows()

f = open('C:/xampp/htdocs/dashboard/QR/decrypted.txt', 'w')
f.write(myData)
f.close()



