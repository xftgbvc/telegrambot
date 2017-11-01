import json
from urllib.request import urlopen
from constants import YOUTUBE_API_KEY

class YouTubePlayList:

    playlistID = 'PL3485902CC4FB6C67'
    maxresults = '50'

    def __init__(self, playlistID, maxresults):
        if int(maxresults) > 50:
            self.maxresults = '50'
        else:
            self.maxresults = maxresults

        self.playlistID = playlistID


    def parse(self):
        data = urlopen(r'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet%2CcontentDetails&maxResults=' +
                       self.maxresults +'&playlistId=' + self.playlistID + '&key=' + YOUTUBE_API_KEY)
        print(data)

        decoded_response = data.read().decode()
        final_data = json.loads(decoded_response)

        videos = []
        items = final_data['items']

        for item in items:
            videos.append({
                'title': item['snippet']['title'],
                'id' : item['contentDetails']['videoId']
            })

        return videos


