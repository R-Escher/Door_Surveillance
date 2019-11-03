#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <SPI.h>
#include <Servo.h>
#include <ArduinoJson.h>

#ifndef STASSID

#define STASSID "ssid"
#define STAPSK  "password"
#endif

#define RST_PIN D1               //PINO DE RESET
#define SS_PIN D2                //PINO SDA aka SERIAL DATA
#define SERVO_PIN D3             //PINO PARA CONTROLAR O SERVO


#include "MFRC522.h"                    //https://www.instructables.com/id/WiFi-RFID-Reader/
MFRC522 rfid(SS_PIN, RST_PIN);          //ATRIBUINDO A VARIÁVEL RFID COMO REF A BIBLIOTECA E PASSANDO PARÂMETROS

Servo servo;

String apiKey = "b79e0ad612c6b94c2f956036a149e5c0";

const char* ssid     = STASSID;
const char* password = STAPSK;

char* host = "http://192.168.15.4";
char* port = "8091";

char * append(char * string1, char * string2, char * separator){
    char * result = NULL;
    asprintf(&result, "%s%s%s", string1, separator, string2);
    return result;
}

void setup() {

    Serial.begin(115200);   //talvez 115200 para o wifi
    SPI.begin();            //INICIALIZA O BARRAMENTO SPI
    rfid.PCD_Init();        //INICIALIZA MFRC522

    
    servo.attach(SERVO_PIN);
    //servo.write(180);   // FECHA A PORTA
    servo.write(0);

    // We start by connecting to a WiFi network
    Serial.println("");
    Serial.print("Connecting to ");
    Serial.print(ssid);
    Serial.println("");

    /*  
        Explicitly set the ESP8266 to be a WiFi-client, otherwise, it by default,
        would try to act as both a client and an access-point and could cause
        network-issues with your other WiFi-devices on your WiFi-network. 
    */
    WiFi.mode(WIFI_OFF);        //Prevents reconnection issue (taking too long to connect)
    delay(500);     
    WiFi.mode(WIFI_STA);
    WiFi.begin(ssid, password);

    while (WiFi.status() != WL_CONNECTED) {
        delay(500);
        Serial.print(".");
    }

    Serial.println("");
    Serial.println("WiFi connected");
    Serial.print("IP address: ");
    Serial.println(WiFi.localIP());
}

void loop() {

    // fica em loop ate cartao ser aproximado
    if (!rfid.PICC_IsNewCardPresent() || !rfid.PICC_ReadCardSerial()){
        delay(500);
        Serial.print(".");
        return;
    }
    Serial.println("\nCard detected.");

    if (WiFi.status() == WL_CONNECTED){

        //
        /// read tag from rfid
        String tagID= ""; 
        for (byte i = 0; i < rfid.uid.size; i++) {
            tagID.concat(String(rfid.uid.uidByte[i] < 0x10 ? "0" : ""));
            tagID.concat(String(rfid.uid.uidByte[i], HEX));
        }
        tagID.toUpperCase();
        //

        //
        ///
        //// HTTP 
        HTTPClient http;
        Serial.print("\nConnecting to "); Serial.print(host);Serial.print(":");Serial.println(port);
        http.begin(append(host, port, ":"));
        http.addHeader("Content-Type", "application/json");

        //
        /// creates a JSON to send tagID and APIKEY to python server
        StaticJsonDocument<256> JSONbuffer;
        JSONbuffer["tagID"] = tagID;   // stores tagID inside json
        JSONbuffer["apiKEY"] = apiKey; // stores apiKey inside json
        char postString[256] = "";     // receives json containing tagID and apiKey
        serializeJson(JSONbuffer, postString, 256); // stores ^^
        //

        // sends POST and gets response http code
        int httpCode = http.POST(postString);
        Serial.print("http code: "); Serial.println(httpCode);
        
        if (httpCode > 0){
            // gets payload response from python server
            String payload = http.getString();
            Serial.print("Response from Server: "); 
            if (httpCode == 200){
                Serial.println("Access allowed! Opening door...");  
                servo.write(90);
                delay(1500);
                servo.write(0);
                delay(1500);

            } else if (httpCode == 401){
                Serial.println("Access denied!");  
            }
            
        } else {
            Serial.println("Http POST Failed!");
        }
        
        http.end();
    }
    delay(500);
    /// 
    //


    /*
    // This will send a string to the server
    Serial.println("sending data to server");
    //client.print("Sent:");
    if (client.connected()) {
    for (byte i = 0; i < rfid.uid.size; i++) {
        //client.print(rfid.uid.uidByte[i] < 0x10 ? " 0" : " ");
        client.print(rfid.uid.uidByte[i], HEX);
    }
    client.print(":");
    client.print(apiKey);
    client.print(":");
    for (byte i = 0; i < 1; i++) {
        byte ch = byte(client.read());
        //client.print(rfid.uid.uidByte[i] < 0x10 ? " 0" : " ");
        Serial.println(ch, HEX);
    }

    byte ch = byte(client.read());
    if(client.read() != -1){
        servo.write(180);
        delay(1500);
        servo.write(-240);
    }else{
        Serial.println('.');
    }


    Serial.println(ch);
    }

    // wait for data to be available
    unsigned long timeout = millis();
    while (client.available() == 0) {
        if (millis() - timeout > 5000) {
            String ch = client.readStringUntil('\n');
            Serial.println(ch);
            Serial.println(">>> Client Timeout !");
            delay(2000);
            client.stop();
            return;
        }
    }

    // not testing 'client.connected()' since we do not need to send data here


    // Close the connection
    Serial.println();
    Serial.println("closing connection");
    client.stop();
    */

    delay(500);
}
