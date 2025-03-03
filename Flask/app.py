from flask import Flask, jsonify, render_template
import requests
from flask_cors import CORS

app = Flask(__name__)
CORS(app)  # Enable CORS for all routes

NODE_SERVER_URL = "http://api:3000/moviesdetail"

# localhost:5000/moviesdetail
@app.route('/moviesdetail', methods=['GET'])
def fetch_data():
    try:
        response = requests.get(NODE_SERVER_URL)
        data = response.json()
        return render_template("index.html", movies=data)  # Pass data to HTML
    except requests.exceptions.RequestException as e:
        return jsonify({"error": str(e)}), 500

if __name__ == '__main__':
    app.run(debug=True, host="0.0.0.0", port=5000)
