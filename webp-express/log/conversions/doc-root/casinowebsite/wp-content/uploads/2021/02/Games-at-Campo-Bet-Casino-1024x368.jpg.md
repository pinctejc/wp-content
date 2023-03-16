WebP Express 0.19.0. Conversion triggered using bulk conversion, 2021-02-19 10:03:55

*WebP Convert 2.3.2*  ignited.
- PHP version: 7.3.27
- Server software: Apache mod_bwlimited/1.4

Stack converter ignited

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/casinowebsite/wp-content/uploads/2021/02/Games-at-Campo-Bet-Casino-1024x368.jpg
- destination: [doc-root]/casinowebsite/wp-content/uploads/2021/02/Games-at-Campo-Bet-Casino-1024x368.webp
- log-call-arguments: true
- converters: (array of 10 items)

The following options have not been explicitly set, so using the following defaults:
- converter-options: (empty array)
- shuffle: false
- preferred-converters: (empty array)
- extra-converters: (empty array)

The following options were supplied and are passed on to the converters in the stack:
- encoding: "lossy"
- metadata: "none"
- quality: 90
------------


*Trying: cwebp* 

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/casinowebsite/wp-content/uploads/2021/02/Games-at-Campo-Bet-Casino-1024x368.jpg
- destination: [doc-root]/casinowebsite/wp-content/uploads/2021/02/Games-at-Campo-Bet-Casino-1024x368.webp
- encoding: "lossy"
- low-memory: true
- log-call-arguments: true
- metadata: "none"
- method: 6
- quality: 90
- use-nice: true
- command-line-options: ""
- try-common-system-paths: true
- try-supplied-binary-for-os: true

The following options have not been explicitly set, so using the following defaults:
- alpha-quality: 85
- auto-filter: false
- default-quality: 75
- max-quality: 85
- near-lossless: 60
- preset: "none"
- size-in-percentage: null (not set)
- skip: false
- rel-path-to-precompiled-binaries: *****
- try-cwebp: true
- try-discovering-cwebp: true
------------

Looking for cwebp binaries.
Discovering if a plain cwebp call works (to skip this step, disable the "try-cwebp" option)
- Executing: cwebp -version 2>&1. Result: *Exec failed* (the cwebp binary was not found at path: cwebp, or it had missing library dependencies)
Nope a plain cwebp call does not work
Discovering binaries using "which -a cwebp" command. (to skip this step, disable the "try-discovering-cwebp" option)
Found 0 binaries
Discovering binaries by peeking in common system paths (to skip this step, disable the "try-common-system-paths" option)
Found 0 binaries
Discovering binaries which are distributed with the webp-convert library (to skip this step, disable the "try-supplied-binary-for-os" option)
Checking if we have a supplied precompiled binary for your OS (Linux)... We do. We in fact have 3
Found 3 binaries: 
- [doc-root]/casinowebsite/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-110-linux-x86-64
- [doc-root]/casinowebsite/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64-static
- [doc-root]/casinowebsite/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-061-linux-x86-64
Detecting versions of the cwebp binaries found
- Executing: [doc-root]/casinowebsite/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-110-linux-x86-64 -version 2>&1. Result: *Exec failed*. Permission denied (user: "kaloyane" does not have permission to execute that binary)
- Executing: [doc-root]/casinowebsite/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64-static -version 2>&1. Result: *Exec failed*. Permission denied (user: "kaloyane" does not have permission to execute that binary)
- Executing: [doc-root]/casinowebsite/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-061-linux-x86-64 -version 2>&1. Result: *Exec failed*. Permission denied (user: "kaloyane" does not have permission to execute that binary)

**Error: ** **No cwebp binaries could be executed (permission denied for user: "kaloyane").** 
No cwebp binaries could be executed (permission denied for user: "kaloyane").
cwebp failed in 229 ms

*Trying: vips* 

**Error: ** **Required Vips extension is not available.** 
Required Vips extension is not available.
vips failed in 1 ms

*Trying: imagemagick* 

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/casinowebsite/wp-content/uploads/2021/02/Games-at-Campo-Bet-Casino-1024x368.jpg
- destination: [doc-root]/casinowebsite/wp-content/uploads/2021/02/Games-at-Campo-Bet-Casino-1024x368.webp
- encoding: "lossy"
- log-call-arguments: true
- metadata: "none"
- quality: 90
- use-nice: true

The following options have not been explicitly set, so using the following defaults:
- alpha-quality: 85
- auto-filter: false
- default-quality: 75
- low-memory: false
- max-quality: 85
- method: 6
- skip: false
------------

Version: ImageMagick 6.9.10-68 Q16 x86_64 2020-12-15 https://imagemagick.org
Quality: 90. 
Consider setting quality to "auto" instead. It is generally a better idea
using nice
Executing command: nice convert -quality '90' -strip -define webp:alpha-quality=85 -define webp:method=6 '[doc-root]/casinowebsite/wp-content/uploads/2021/02/Games-at-Campo-Bet-Casino-1024x368.jpg' 'webp:[doc-root]/casinowebsite/wp-content/uploads/2021/02/Games-at-Campo-Bet-Casino-1024x368.webp' 2>&1

*Output:* 
convert: delegate failed `'cwebp' -quiet %Q '%i' -o '%o'' @ error/delegate.c/InvokeDelegate/1928.

return code: 1

**Error: ** **The exec call failed** 
The exec call failed
imagemagick failed in 237 ms

*Trying: graphicsmagick* 

**Error: ** **gmagick is not installed** 
gmagick is not installed
graphicsmagick failed in 17 ms

*Trying: ffmpeg* 

**Error: ** **ffmpeg is not installed (cannot execute: "ffmpeg")** 
ffmpeg is not installed (cannot execute: "ffmpeg")
ffmpeg failed in 17 ms

*Trying: wpc* 

**Error: ** **Missing URL. You must install Webp Convert Cloud Service on a server, or the WebP Express plugin for Wordpress - and supply the url.** 
Missing URL. You must install Webp Convert Cloud Service on a server, or the WebP Express plugin for Wordpress - and supply the url.
wpc failed in 0 ms

*Trying: ewww* 

**Error: ** **Missing API key.** 
Missing API key.
ewww failed in 0 ms

*Trying: imagick* 

**Error: ** **Required iMagick extension is not available.** 
Required iMagick extension is not available.
imagick failed in 0 ms

*Trying: gmagick* 

**Error: ** **Required Gmagick extension is not available.** 
Required Gmagick extension is not available.
gmagick failed in 0 ms

*Trying: gd* 

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/casinowebsite/wp-content/uploads/2021/02/Games-at-Campo-Bet-Casino-1024x368.jpg
- destination: [doc-root]/casinowebsite/wp-content/uploads/2021/02/Games-at-Campo-Bet-Casino-1024x368.webp
- log-call-arguments: true
- quality: 90

The following options have not been explicitly set, so using the following defaults:
- default-quality: 75
- max-quality: 85
- skip: false

The following options were supplied but are ignored because they are not supported by this converter:
- encoding
- metadata
- skip-pngs
------------

GD Version: bundled (2.1.0 compatible)
image is true color
Quality: 90. 
Consider setting quality to "auto" instead. It is generally a better idea
gd succeeded :)

Converted image in 599 ms, reducing file size with 8% (went from 55 kb to 50 kb)
