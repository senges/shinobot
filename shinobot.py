from urllib import parse

import requests
import lxml
import time
import random

URL =  'http://www.shinobi.fr/index.php'

class Shinobot:

    def __init__(self, login, password):
        self.session = requests.Session()
        self.login(login, password)

    # -- Program panic (will exit)
    def panic(self, msg):
        print(f'Program panic : {msg}')
        exit(1)

    # -- Generic POST method
    def post(self, page, params):
        self._waitLikeHumans()
        
        r = self.session.post (
            f'{URL}?page={page}',
            data = parse.urlencode( params )
        )

        if r.status_code != 200:
            self.panic(f'HTTP ({page})[{r.status_code}] expected status 200')

        return r.text

    # -- Start session
    def login(self, login, password):
        params = {
            'login'  : login,
            'pass'   : password
        }

        self.post('connexion', params)

    # -- Properly destroy session
    def logout(self):
        self.session.close()

    # ---------- MISCS ---------- #

    # -- Robots tends to be a little fast
    def _waitLikeHumans(self):
        time.sleep(random.randint(1,6))

    # ---------- COMMON ---------- #

    # -- Fetch available PA
    def fetchPA(self):
        raise ValueError('Not yet implemented')

    # ---------- ACTIONS ---------- #

    # -- Start auto-pilot
    def run(self):
        raise ValueError('Not yet implemented')

    # -- Dig for interresting stuff
    def dig(self):
        raise ValueError('Not yet implemented')

    # -- LvL up if possible
    def lvlup(self):
        raise ValueError('Not yet implemented')

    # -- Come back to life
    def revive(self):
        raise ValueError('Not yet implemented')

    # -- Work for the chunin exam
    def learn(self):
        raise ValueError('Not yet implemented')

    # -- Fight properly according to the context
    def fight(self):
        raise ValueError('Not yet implemented')

    # -- Train ninjutsu
    def trainNin(self):
        raise ValueError('Not yet implemented')

    # -- Train genjutsu
    def trainGen(self):
        raise ValueError('Not yet implemented')

    # -- Train taijutsu
    def trainTai(self):
        raise ValueError('Not yet implemented')

     # ---------- STATUS ---------- #

    # -- User is dead ?
    def isDead(self):
        raise ValueError('Not yet implemented')

    # -- User reached max xp ?
    def isXpFull(self):
        raise ValueError('Not yet implemented')

    # -- User is in fight ?
    def isFighting(self):
        raise ValueError('Not yet implemented')
