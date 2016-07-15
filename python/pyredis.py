import redis
import paho.mqtt.client as mqttP
import json
import pdb

#REDIS ***********************
def my_handler(message):
    #print 'MY HANDLER: ', message['data']
    #print message['data']
    data = json.loads(message['data'])
    print data['topic']
    if 'dir' in data.keys():
        data.pop('dir',None)
        topic = data['topic']
        mqtt_pub(json.dumps(data),topic)
    else:
        topic = data['topic']
        print data['value'], topic
        r.set(topic,data['value'])


r = redis.StrictRedis(host='localhost', port=6379, db=0)
p = r.pubsub()
p.subscribe(**{'mqtt-channel': my_handler})
thread = p.run_in_thread(sleep_time=0.001)
#t=p.get_message()
#print(t)

def redis_pub(data):
    r.publish('mqtt-channel', data)


#MQTT*************************
import paho.mqtt.client as mqtt


# The callback for when the client receives a CONNACK response from the server.
def on_connect(client, userdata, flags, rc):
    print("Connected with result code "+str(rc))

    # Subscribing in on_connect() means that if we lose the connection and
    # reconnect then subscriptions will be renewed.
    client.subscribe("DEV/#")

# The callback for when a PUBLISH message is received from the server.
def on_message(client, userdata, msg):
    redis_pub(msg.payload)



client = mqtt.Client()
client.username_pw_set('su1','1234')
client.on_connect = on_connect
client.on_message = on_message


def mqtt_pub(data,topic):
    print 'PUBLISHING TO SERVER MQTT'
    print topic
    client.publish(topic,data)


client.connect("127.0.0.1", 1883, 60)

# Blocking call that processes network traffic, dispatches callbacks and
# handles reconnecting.
# Other loop*() functions are available that give a threaded interface and a
# manual interface.
client.loop_forever()



