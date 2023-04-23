FROM node:18.16.0-slim

# Install system dependencies
RUN apt-get update && \
    apt-get install -y vim && \
    apt-get install -y curl && \
    apt-get install -y wget && \
    apt-get install -y zip && \
    apt-get install -y unzip && \
    apt-get install -y git && \
    apt-get install -y openssl && \
    apt-get install -y bash && \
    apt-get install -y htop

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Configure user
RUN groupadd -g 1001 test-logcomex-front && \
useradd -u 1001 -g test-logcomex-front -G www-data -m test-logcomex-front && \
usermod -p "*" test-logcomex-front -s /bin/bash && \
usermod -a -G www-data test-logcomex-front

# Define work directory
WORKDIR /var/www

# Remove unnecessary directory
RUN rm -rf /var/www/html

# Expose port
# EXPOSE 5173

# Define entrypoint
ENTRYPOINT ["node"]
