import numpy as np
import cv2 

from pyzbar.pyzbar import decode

cap = cv2.VideoCapture(0,cv2.CAP_DSHOW)
cap.set(3,640)
cap.set(4,480)
camera = True


while camera == True:
    succes, img = cap.read()
    for code in decode(img):
        myData = code.data.decode('utf-8')
        print(myData)
        
        ##Dibuja un contorno en el codigo QR encontrado
        cv2.rectangle(img, (code.rect[0], code.rect[1]), (code.rect[0] + code.rect[2], code.rect[1] + code.rect[3]), (0, 255, 0), 2)
        
        ## Divide My Data en una lista
        myData1 = myData.split("\n")
        cv2.putText(img, myData1[1], (code.rect[0], code.rect[1] + code.rect[3] + 20), cv2.FONT_HERSHEY_SIMPLEX, 1, (0, 0, 255), 2)      
            
        d = open('decrypted.txt', 'r')
        if str(myData) != str(d):
            f = open('C:/xampp/htdocs/dashboard/QR/decrypted.txt', 'w')
            f.write(myData)
            f.close() 
    
    
    cv2.imshow('Result',img)
    
    
    if cv2.waitKey(1) == ord('w'):
        break

cv2.destroyAllWindows()
cap.release()

#Envia la información a un formulario HTML
#import requests
#url = 'http://localhost:8080/'
#data = {'data': myData1[1]}
#r = requests.post(url, data=data)




#f = open('C:/xampp/htdocs/dashboard/QR/decrypted.txt', 'w')
#f.write(myData)
#f.close()

"""
Si myData es igual al contenido en decrypted.txt, continua el programa si no se vuelve a escribir decrypted.txt
    d = open("decrypted.txt", "r")
    if myData != d:
        f = open('C:/xampp/htdocs/dashboard/QR/decrypted.txt', 'w')
        f.write(myData)
        f.close() 
"""

