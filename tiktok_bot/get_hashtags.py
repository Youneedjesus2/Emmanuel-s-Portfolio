import requests
from bs4 import BeautifulSoup

def fetch_trending_hashtags():
    url = "https://www.tiktok.com/trending"
    response = requests.get(url)
    soup = BeautifulSoup(response.text, "html.parser")

    hashtags = []
    for tag in soup.find_all("span", class_="trending-hashtag"):
        hashtags.append(tag.text)

    return " ".join(hashtags[:5])  # Return top 5 trending hashtags

if __name__ == "__main__":
    print(fetch_trending_hashtags())
