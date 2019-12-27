from flask import Flask, jsonify, request, send_file
from moviepy.editor import *
import os

clip = VideoFileClip('seed.mp4'); 
app = Flask(__name__)

@app.route('/video/getinfo', methods=['GET'])
def infos():
    return jsonify({
        'infos' : {
            'size' : clip.size,
            'w' : clip.w,
            'h' : clip.h,
            'filename' : clip.filename,
            'fps' : clip.fps,
            'duration' : clip.duration
        } }
    )
 
@app.route('/video/getthumbnail', methods=['GET'])
def thumbnail():
    img_name = clip.filename.rsplit('.', 1)[0] + '_thumbnail.jpg';
    clip.save_frame(img_name, t=clip.duration/2)    

    return jsonify({'path' : img_name})
     
@app.route('/video/preview', methods=['GET'])
def preview():
    preview = clip.subclip(t_start=clip.duration/2, t_end=clip.duration/2+3)
    preview.write_videofile('preview.mp4', audio=False, fps=10)
    return jsonify(clip.duration/2)
 
if __name__ == '__main__':
    app.run(debug=True, port=8080)