/*
 *  This sketch sends data via HTTP GET requests to my local server.
*/

#include <WiFi.h>

const char* ssid = "eircom34504330";
const char* password = "919fef37855f";

const char* host = "192.168.1.1";

const int gpio0 = 0;
const int buttonPin = 2;
int buttonState = 0;

void setup() {
  Serial.begin(115200);
  delay(10);
  digitalWrite(2, LOW);
  pinMode(buttonPin, INPUT);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println();
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
  Serial.println(WiFi.RSSI());
}

void loop() {
  delay(5000);

  Serial.print("Connecting to ");
  Serial.println(host);

  // Use WiFiClient class to create TCP connections
  WiFiClient client;
  const int httpPort = 80;
  if (!client.connect(host, httpPort))
  {
    Serial.println("connection failed");
    return;
  }

  String url = "/includes/put_data.php";
  url += "?esp_id=17";
  url += "&esp_zone=19";
  url += "&esp_location=Kitchen";
  url += "&esp_batt=4.01";
  url += "&esp_rx_level=";
  url += analogRead(A0);

  String line = "";
  Serial.print("Requesting URL: ");
  Serial.println(url);

  // This will send the request to the server
  client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" +
               "Connection: close\r\n\r\n");
  // Read all the lines of the reply from server and print them to Serial
  while(client.available())
  {
    line = client.readStringUntil('\r');
    Serial.println(line);
  }

  Serial.println();
  Serial.println("Closing connection...");

}
