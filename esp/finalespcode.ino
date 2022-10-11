int const uid = 76;


//IMPORT NECESSARY LIBRARIES
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>

//DECLARING NETWORK NAME AND PASSWORD
const char* ssid = "SWATER";
const char* pwd = "smartwater";

//GET URL
String serverName = "http://192.168.4.2:80/swater/update.php";

//TIME CONTROL
unsigned long lastTime = 0;
unsigned long timerDelay = 5000;

//EXTRA VARIABLES
int pulse = 0;
//int x = 0;
const int input1 = 4;
const float volperpulse = 0.1;
float water = 0;
int lastpulse = 0;
const int threshold = 300; //threshold in ms

void setup() {
  Serial.begin(115200);
  WiFi.softAP(ssid, pwd);
  pinMode(input1, INPUT);
}

void loop() {
  if (millis()-lastpulse > threshold){
    if(digitalRead(input1) > 0){ //x was replaced with 0 here
      //x = 1;
      pulse++;
      lastpulse = millis();
      water = pulse*volperpulse;
      Serial.print(water);
      Serial.print("L of water have been used.\n");
    }
  }

  //if(digitalRead(input1) == 0) {x = 0;}

  if ((millis() - lastTime) > timerDelay) {
    WiFiClient client;
    HTTPClient http;
    String serverPath = serverName + "?water=" + water + "&uid=" + uid;
    pulse = 0; water = 0;

    http.begin(client, serverPath.c_str());

    int httpResponseCode = http.GET();
    
    if (httpResponseCode>0) {
      Serial.print("Response code: ");
      Serial.println(httpResponseCode);
      String payload = http.getString();
      Serial.println(payload);
    }
    else {
      Serial.print("Error code: ");
      Serial.println(httpResponseCode);
    }
    http.end();
    lastTime = millis();
  }

  delay(1);
}