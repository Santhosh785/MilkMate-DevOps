FROM ubuntu:latest

ARG DEBIAN_FRONTEND=noninteractive

WORKDIR /var/milkmate

RUN apt update && \
    apt upgrade -y && \
    apt install -y apache2 php libapache2-mod-php php-mysql nano git && \
    rm -rf /var/www/html || true && \
    apt clean && rm -rf /var/lib/apt/lists/*

# ⬇️ COPY must be separate!
COPY ./data/ .

RUN chmod +x /var/milkmate/main.sh

CMD ["/var/milkmate/main.sh"]
