#!/usr/bin/env bash
Fail() { echo "ERROR: $@" 1>&2; exit 1; }

for c in setfacl openssl ; do
  which $c >/dev/null 2>&1 || Fail "$c not found"
done

echo "Trying to find .env.local"

if [ -f .env.local ]
then
  echo ".env.local found!"
  env_config=".env.local"
else
  if [ -f .env ]
  then
    echo ".env.local not found!"
    echo "Generating secret keys using .env config"
    env_config=".env"
  else
    Fail ".env and .env.local not found"
  fi
fi

set -ex pipefail

cd "$(cd "$(dirname "$0")" && pwd)/.."

mkdir -p config/jwt
jwt_passphrase=${JWT_PASSPHRASE:-$(grep ''^JWT_PASSPHRASE='' "$env_config" | cut -f 2 -d ''='')}
echo "$jwt_passphrase" | openssl genpkey -out config/jwt/private.pem -pass stdin -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
echo "$jwt_passphrase" | openssl pkey -in config/jwt/private.pem -passin stdin -out config/jwt/public.pem -pubout
setfacl -R -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
setfacl -dR -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt