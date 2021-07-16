import requests
from requests import get
import json
from pprint import pprint
import RPi.GPIO as gpio
import serial
import time

SERIAL_PORT ="/dev/ttyS0"
ser= serial.Serial(SERIAL_PORT,baudrate=9600,timeout=5)

r =requests.get('https://dysenteric-training.000webhostapp.com/read.php')
response=json.loads(r.text)
flag=0
count=0
id_list=[]
def Sendmessage(test):
    def send(x):
        global ser
        ser.write(x.encode('ascii','ignore'))
    send("AT+CMGF=1\r")
    time.sleep(2)
    send('AT+CMGS="630*******"\r')
    msg="FIRE ALERT!!!!!!!!!!"
    time.sleep(3)
    send(msg+"--station="+test+chr(26))
    time.sleep(3)
for i in response['fire_sense']:
    id_list.append(int(i['id']))
for elements in response['fire_sense']:
    if(int(elements['id'])==max(id_list)):
            print(max(id_list))
            if(int(elements['hum'])<60):
                print(elements['hum'],end=' ')
                flag=1
            if(int(elements['temp'])>26):
                print(elements['temp'])
                count=1
            if(flag==1 and count==1):
                Sendmessage(elements['station'])







