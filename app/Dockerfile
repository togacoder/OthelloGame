FROM php:7.3-cli

ARG UID=1000
ARG USER=admin
ARG PASS=admin
RUN useradd -m --uid ${UID} --groups sudo ${USER} \
  && echo ${USER}:${PASS} | chpasswd

RUN apt-get update && apt-get install -y \
  apt-utils \
  sudo \
  vim \
  && apt-get -y clean \
  && rm -rf /var/lib/apt/lists/*

RUN mkdir /home/${USER}/src
RUN chmod 777 /home/${USER}/src
COPY ./config/.vimrc /home/${USER}/.