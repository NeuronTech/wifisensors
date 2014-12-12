/*
  Version 1.0.0 is original from net: link below...
  Version 1.0.2 works ....

  ESP8266: 901 and 901 use 115200, for 902 use 9600 baud.

  Include version display on TFT ...

  Does not use software dialogue, uses TFT

  Based on: http://zeflo.com/2014/esp8266-weather-display/

*/

#include <JsonParser.h>

// Pins for TFT display //
#define cs		   10
#define dc		    8
#define rst		    9

// continue pin //
#define CONTINUE 12

#include <Adafruit_GFX.h>    // Core graphics library
#include <Adafruit_ST7735.h> // Hardware-specific library
#include <SPI.h>

Adafruit_ST7735 tft = Adafruit_ST7735(cs, dc, rst);

using namespace ArduinoJson::Parser;

#define SSID "YOUR SSID" // insert your SSID
#define PASS "YOUR PASSWORD" // insert your password
#define LOCATIONID "YOUR LOCATION ID" // location id (google for yours)...
#define DST_IP "188.226.224.148" //api.openweathermap.org

JsonParser<32> parser;

char info[256] = "{";
char msg[80] = "";

void setup()
{
  pinMode(12, INPUT);

  Serial.begin(9600); // firmware 902 //
  Serial.setTimeout(5000);

  tft_init();

  Serial.println("AT+RST"); // restet and test if module is ready
  delay(1500);
  if(Serial.find("Ready"))
  {
    tft.println("WiFi - Module is ready");
  }
  else
  {
    tft.println("No response from Module, please restart...");
    while(1);
  }

  get_key_press("WiFi is ready");

  // try to connect to wifi
  boolean connected=false;
  for (int i = 0; i < 5; i++)
  {
    if (connectWiFi())
    {
      connected = true;
      tft.println("Connected to WiFi...");
      break;
    }
  }
  if (!connected)
  {
    tft.println("Couldn't connect to WiFi.");
    while(1);
  }

  delay(100);

  tft.print("Testing Version");
  Serial.println("AT+GMR");
  show_incoming();
  get_key_press("Press next...");

  Serial.println("AT+CIPMUX=0"); // set to single connection mode
}

void loop()
{
  String cmd = "AT+CIPSTART=\"TCP\",\"";
  cmd += DST_IP;
  cmd += "\",80";
  Serial.println(cmd);
  tft.print(cmd);
  if (Serial.find("Error")) return;

  cmd = "GET /data/2.5/weather?id=";
  cmd += LOCATIONID;
  cmd += " HTTP/1.0\r\nHost: api.openweathermap.org\r\n\r\n";
  Serial.print("AT+CIPSEND=");
  Serial.println(cmd.length());

  if(Serial.find(">"))
  {
    tft.print(">");
  }
  else
  {
    Serial.println("AT+CIPCLOSE");
    tft.fillScreen(ST7735_BLACK);
    tft.setCursor(1, 1);
    tft.setTextColor(ST7735_WHITE);
    tft.println("connection timeout");
    delay(1000);
    return;
  }

  Serial.print(cmd);
  unsigned int i = 0; //timeout counter
  int n = 1; // char counter
  char json[100]="{";

  while (!Serial.find("\"main\":{")){} // find the part we are interested in.

  while (i < 60000)
  {
    if(Serial.available())
    {
      char c = Serial.read();
      json[n]=c;
      if(c=='}') break;
      n++;
      i=0;
    }
    i++;
  }

  JsonObject root = parser.parse(json);
  double temp = root["temp"];
  double pressure = root["pressure"];
  double humidity = root["humidity"];
  temp -= 273.15; // from kelvin to degree celsius
  tft.fillScreen(ST7735_BLACK);
  tft.setCursor(2, 25);
  tft.setTextColor(ST7735_BLUE);
  tft.setTextSize(2);
  tft.print("Temp: ");
  tft.print((int)temp);
  tft.print(".");
  tft.print((int)((temp-(int)temp)*10));
  tft.println(" C");
  tft.setCursor(2, 55);
  tft.setTextColor(ST7735_GREEN);
  tft.setTextSize(2);
  tft.print("Press: ");
  tft.print((int)pressure);
  tft.setCursor(2, 85);
  tft.setTextColor(ST7735_YELLOW);
  tft.setTextSize(2);
  tft.print("Humid: ");
  tft.print((int)humidity);
  tft.println("%");
  delay(600000);
}

boolean connectWiFi()
{
  Serial.println("AT+CWMODE=1");
  String cmd="AT+CWJAP=\"";
  cmd+=SSID;
  cmd+="\",\"";
  cmd+=PASS;
  cmd+="\"";
  tft.println(cmd);
  Serial.println(cmd);
  delay(2000);

  if(Serial.find("OK"))
  {
    tft.println("OK, Connected to WiFi.");
    return true;
  }
  else
  {
    tft.println("Cannot connect to the WiFi.");
    return false;
  }
}

void tft_init(void)
{
  tft.initR(INITR_BLACKTAB);
  tft.setRotation(1);
  tft.fillScreen(ST7735_BLACK);
  tft.setCursor(1, 1);
  tft.setTextColor(ST7735_WHITE);
  tft.println("Connect Hardware Seraial");
  get_key_press("Press to begin...");
  tft.fillScreen(ST7735_BLACK);
  tft.setCursor(1, 1);
  tft.println("ESP8266 Weather Code....");
}

int show_incoming()
{
  tft.fillScreen(ST7735_BLACK);
  tft.setCursor(1, 1);
  Serial.readBytes(info, 128);
  delay(500);
  tft.println(info);
}

// delay until a key is pressed, no de bounce required //
// allows us to control the process, can be removed later //
void get_key_press(String msg)
{
  tft.setCursor(0, 116);
  tft.println(msg);
  while(digitalRead(CONTINUE) == 0);
  show_incoming();
}
