
from flask import Flask
import time

app = Flask(__name__)

@app.route('/generate_load')
def generate_load():
    # Simulate CPU load by performing a long-running computation
    result = 0
    for i in range(10000000):
        result += i
    return f"Load generation completed with result {result}"

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5001)
