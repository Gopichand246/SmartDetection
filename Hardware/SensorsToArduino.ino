#include <dht.h>
#include <SoftwareSerial.h>
SoftwareSerial s1(5,6); //Rx, Tx
SoftwareSerial s2(2,3);
SoftwareSerial s3(8,9);

dht DHT;
#define dht_pin A0
#define flame_pin A1
void setup() {
  pinMode(flame_pin,INPUT);
  pinMode(dht_pin,INPUT);
  Serial.begin(9600);
  s1.begin(9600);
  s2.begin(9600);
  s3.begin(9600);
}
 
void loop() {
DHT.read11(dht_pin);
 int hum_value = DHT.humidity;
 int temp_value= DHT.temperature; 
int flame_value= analogRead(flame_pin);
s1.write(flame_value);
s2.write(temp_value);     
s3.write(hum_value);
Serial.println("temperature=");
Serial.println(temp_value);
Serial.println("Humidity percentage =");
Serial.println(hum_value);
Serial.println("flame_value=");
Serial.println(flame_pin);
delay(3000);
}
/*
#include <SoftwareSerial.h>
#include <ArduinoJson.h>
SoftwareSerial s(5,6);
 
void setup() {
s.begin(9600);
}
 
void loop() {
 StaticJsonBuffer<1000> jsonBuffer;
 JsonObject& root = jsonBuffer.createObject();
  root["data1"] = 100;
  root["data2"] = 200;
if(s.available()>0)
{
 root.printTo(s);
}
}
 */
