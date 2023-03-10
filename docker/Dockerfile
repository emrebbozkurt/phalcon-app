FROM php:8.1-fpm

# User/Group globals
ENV MY_USER="phalcon" \
    MY_GROUP="phalcon" \
    MY_UID="1000" \
    MY_GID="1000" \
    PHP_VERSION="8.1" \
    LANG=en_US.UTF-8 \
    LANGUAGE=en_US.UTF-8 \
    LC_ALL=en_US.UTF-8

# User and Group
RUN set -eux && \
	groupadd -g ${MY_GID} -r ${MY_GROUP} && \
	useradd -u ${MY_UID} -m -s /bin/bash -g ${MY_GROUP} ${MY_USER}

# Update
RUN apt update -y && \
    apt install -y \
        apt-utils \
        gettext \
        git \
        libgmp-dev \
        libicu-dev \
        libmagickwand-dev \
        libmemcached-dev \
        libpng-dev \
        libpq-dev \
        libyaml-dev \
        libwebp-dev \
        libxpm-dev \
        libzip-dev \
        locales \
        nano \
        sudo \
        wget \
        curl \
        unzip \
        zip

# PECL Packages
RUN pecl install -o -f redis && \
    pecl install imagick \
      memcached \
      phalcon \
      xdebug \

# Locale
RUN sed -i -e 's/# de_DE.UTF-8 UTF-8/de_DE.UTF-8 UTF-8/' /etc/locale.gen && \
    sed -i -e 's/# el_GR.UTF-8 UTF-8/el_GR.UTF-8 UTF-8/' /etc/locale.gen && \
    sed -i -e 's/# en_US.UTF-8 UTF-8/en_US.UTF-8 UTF-8/' /etc/locale.gen && \
    sed -i -e 's/# es_ES.UTF-8 UTF-8/es_ES.UTF-8 UTF-8/' /etc/locale.gen && \
    sed -i -e 's/# ru_RU.UTF-8 UTF-8/ru_RU.UTF-8 UTF-8/' /etc/locale.gen && \
    dpkg-reconfigure --frontend=noninteractive locales && \
    update-locale LANG=en_US.UTF-8

# Locale Environment
ENV LANG=en_US.UTF-8 \
    LANGUAGE=en_US.UTF-8 \
    LC_ALL=en_US.UTF-8

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype  \
    --with-jpeg=/usr/include/  \
    --with-xpm \
    --with-webp \
    --enable-gd

RUN docker-php-ext-install \
        gd \
        gettext \
        gmp \
        intl \
        pdo_mysql \
        zip

# Install PHP extensions
RUN docker-php-ext-enable \
        gettext \
        redis \
        imagick \
        memcached \
        phalcon \
        xdebug

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www