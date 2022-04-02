# personal-2021

## Developing locally

1. Build the container:

```
docker build . -t personal
```

2. Modify the content directory and run the container:

```
docker run -v "$PWD"/dist:/app/dist -v "$PWD"/content:/app/content personal

```

Output will appear in the /dist folder
