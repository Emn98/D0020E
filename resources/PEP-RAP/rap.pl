
%:- use_module(library(http/http_client)).

:- use_module(library(http/thread_httpd)).
:- use_module(library(http/http_dispatch)).
:- use_module(library(http/http_wrapper)).
:- use_module(library(http/http_header)).
:- use_module(library(http/http_parameters)).

file_open(Object,r,Stream) :-
	format('rap: opening ~a~n',Object),
	open(Object,read,Stream).
	
file_open(Object,w,Stream) :-
	format('rap: opening ~a~n',Object),
	open(Object,write,Stream).

file_close(Stream) :-
	writeln('rap: closing'),
	close(Stream).

file_read(Stream,ReadData) :-
	read_stream_to_codes(Stream,ReadData).

file_write(Stream, Data) :-
	format('rap: writing ~a~n', Data),
	write(Stream, Data).
