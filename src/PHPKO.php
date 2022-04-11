<?php

SDL_Init(SDL_INIT_EVERYTHING);

$window_size = [1200, 650];

$window = SDL_CreateWindow("PHPKO", SDL_WINDOWPOS_CENTERED, SDL_WINDOWPOS_CENTERED,
	$window_size[0], $window_size[1], SDL_WINDOW_OPENGL | SDL_WINDOW_SHOWN);
SDL_GL_CreateContext($window);

glClearColor(0, 0, .2, 1);
glClear(GL_COLOR_BUFFER_BIT);
SDL_GL_SwapWindow($window);

$renderer = SDL_CreateRenderer($window, -1, 0);

$images = [];

$login  = IMG_Load("login.jpg");
$logout = IMG_Load("logout.jpg");
$images["login"]  = SDL_CreateTextureFromSurface($renderer, $login);
$images["logout"] = SDL_CreateTextureFromSurface($renderer, $logout);
SDL_FreeSurface($login);
SDL_FreeSurface($logout);

$event = new SDL_Event;
while(true) {
	SDL_PollEvent($event);
	\SDL_SetRenderDrawColor($renderer, 0, 0, 0, 0);
	\SDL_RenderClear($renderer);
	SDL_RenderCopy($renderer, $images["login"], null, null);
	if($event->type == SDL_KEYDOWN) {
		if($event->key->keysym->sym === 27) { // ALT + F4
			SDL_RenderClear($renderer);
			SDL_RenderCopy($renderer, $images["logout"], null, null);
			SDL_RenderPresent($renderer);
			sleep(5);
			break;
		}
	}
	SDL_RenderPresent($renderer);
	SDL_Delay(10);
}

SDL_DestroyRenderer($renderer);
SDL_DestroyWindow($window);
SDL_Quit();
