#include <ESP8266WiFi.h>
#include <SoftwareSerial.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h> 
#include <ThingSpeak.h>

SoftwareSerial s1(12,14);
SoftwareSerial s2(13,15); //Rx(D7),Tx(D8)
SoftwareSerial s3(5,4);//Rx(D1),Tx(D2)

const char* ssid     = "IIITS_Student";
const char* password = "iiit5@2k18";
const char* host = "dysenteric-training.000webhostapp.com";

int temp_value;
int hum_value;
int smoke_value;
char station='A';

unsigned long myChannelNumber = 931806; //Your Channel Number (Without Brackets)
const char * myWriteAPIKey = "HJ37MXYGU9BC6O9O"; //Your Write API Key

WiFiClient client;
 
void setup() {
  Serial.begin(9600);
  s1.begin(9600);
  s2.begin(9600);
  s3.begin(9600);
  delay(100);
  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);
  WiFi.begin(ssid, password); 
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");  
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
  Serial.print("Netmask: ");
  Serial.println(WiFi.subnetMask());
  Serial.print("Gateway: ");
  Serial.println(WiFi.gatewayIP());
  ThingSpeak.begin(client);
}
void loop() {
  if (WiFi.status() == WL_CONNECTED) { //Check WiFi connection status
    if(s1.available()>0)
    {
      smoke_value=s1.read();
      Serial.println("Smoke=");
      Serial.println(smoke_value);
    }
    if (s2.available()>0)
  {
    temp_value=s2.read();
    Serial.println("temperature =");
    Serial.println(temp_value);
  }
if (s3.available()>0)
  {
    hum_value=s3.read();
    Serial.println("Humidity=");
    Serial.println(hum_value);
}
  }
  if (isnan(temp_value) || isnan(hum_value) || isnan(smoke_value)) {
    Serial.println("Failed to read from DHT sensor!");
    return;
  }
  
  Serial.print("connecting to ");
  Serial.println(host);
  WiFiClient client;
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) {
    Serial.println("connection failed");
    return;
  }
  String url = "/insert.php?station=" +String(station)+ "&temp=" + String(temp_value) + "&hum="+ String(hum_value) + "&smoke=" +String(smoke_value);
  Serial.print("Requesting URL: ");
  Serial.println(url);
  client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" + 
               "Connection: close\r\n\r\n");
  delay(500);
  while(client.available()){
    String line = client.readStringUntil('\r');
    Serial.print(line);
  }
  Serial.println();
  Serial.println("closing connection");
  
  ThingSpeak.writeField(myChannelNumber, 1,temp_value, myWriteAPIKey); //Update in ThingSpeak
  ThingSpeak.writeField(myChannelNumber, 2,hum_value, myWriteAPIKey); //Update in ThingSpeak
  ThingSpeak.writeField(myChannelNumber, 3,smoke_value, myWriteAPIKey); //Update in ThingSpeak
  
  delay(500000);
}
