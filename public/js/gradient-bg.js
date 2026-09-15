// ==========================================================
// FOND ANIME EN WEBGL (remplace le degrade CSS)
// Peint un canvas plein ecran derriere tout le site avec un
// "shader" (un petit programme qui tourne sur la carte graphique
// et calcule la couleur de chaque pixel, image par image).
// Couleurs BDE : violet -> fuchsia -> orange, effet organique.
// ==========================================================

(function () {
    // Si le navigateur ne supporte pas WebGL2, on ne fait rien :
    // le fond de secours defini dans app.css (couleur unie) reste affiche.
    var canvas = document.createElement('canvas');
    canvas.id = 'bde-gradient-bg';
    // filter: sature les couleurs que le shader produit (evite l'effet "delave")
    canvas.style.cssText = 'position:fixed;inset:0;z-index:-1;width:100%;height:100%;display:block;filter:saturate(1.9) contrast(1.08);';
    document.body.prepend(canvas);

    var gl = canvas.getContext('webgl2', { premultipliedAlpha: true, alpha: true, antialias: true });
    if (!gl) return;

    // ----- Reglages du degrade (nos 3 couleurs BDE + forme/mouvement) -----
    var params = {
        color1: hexToRgba('#4F116F'), // violet, couleur de base
        color2: hexToRgba('#EF3A2F'), // rouge corail, couleur du milieu (plus vive que le fuchsia entre violet et orange)
        color3: hexToRgba('#F7521C'), // orange, couleur d'accent
        rotation: 110,
        proportion: 0.55,
        scale: 0.5,
        speed: 18,       // vitesse de l'animation
        distortion: 0.02, // presque plus de "grain" entre les couleurs
        swirl: 0.12,      // tourbillon discret, evite les zones melangees
        swirlIterations: 6,
        softness: 0.08,   // transitions nettes (avant 1 = tout delave)
        shape: 2,        // 2 = "Edge" (vagues douces, comme un fondu)
        shapeSize: 0.4,
    };

    // ----- Deux petits programmes envoyes a la carte graphique -----
    // Le vertex shader place juste un grand rectangle qui couvre tout l'ecran.
    var VERTEX_SHADER = '#version 300 es\n' +
        'in vec4 a_position;\n' +
        'void main() { gl_Position = a_position; }';

    // Le fragment shader calcule la couleur de CHAQUE pixel : bruit + tourbillon
    // + degrade entre nos 3 couleurs. C'est la partie complexe (maths de shader),
    // on ne la modifie pas a la main, on ajuste seulement "params" ci-dessus.
    var FRAGMENT_SHADER = '#version 300 es\n' +
        'precision highp float;\n' +
        'uniform float u_time; uniform float u_pixelRatio; uniform vec2 u_resolution;\n' +
        'uniform float u_scale; uniform float u_rotation;\n' +
        'uniform vec4 u_color1; uniform vec4 u_color2; uniform vec4 u_color3;\n' +
        'uniform float u_proportion; uniform float u_softness; uniform float u_shape;\n' +
        'uniform float u_shapeScale; uniform float u_distortion; uniform float u_swirl; uniform float u_swirlIterations;\n' +
        'out vec4 fragColor;\n' +
        '#define TWO_PI 6.28318530718\n' +
        '#define PI 3.14159265358979323846\n' +
        'vec2 rotate(vec2 uv, float th) { return mat2(cos(th), sin(th), -sin(th), cos(th)) * uv; }\n' +
        'float random(vec2 st) { return fract(sin(dot(st.xy, vec2(12.9898, 78.233))) * 43758.5453123); }\n' +
        'float noise(vec2 st) {\n' +
        '  vec2 i = floor(st); vec2 f = fract(st);\n' +
        '  float a = random(i); float b = random(i + vec2(1.0, 0.0));\n' +
        '  float c = random(i + vec2(0.0, 1.0)); float d = random(i + vec2(1.0, 1.0));\n' +
        '  vec2 u = f * f * (3.0 - 2.0 * f);\n' +
        '  float x1 = mix(a, b, u.x); float x2 = mix(c, d, u.x);\n' +
        '  return mix(x1, x2, u.y);\n' +
        '}\n' +
        'vec4 blend_colors(vec4 c1, vec4 c2, vec4 c3, float mixer, float edgesWidth, float edge_blur) {\n' +
        '    vec3 color1 = c1.rgb * c1.a; vec3 color2 = c2.rgb * c2.a; vec3 color3 = c3.rgb * c3.a;\n' +
        '    float r1 = smoothstep(.0 + .35 * edgesWidth, .7 - .35 * edgesWidth + .5 * edge_blur, mixer);\n' +
        '    float r2 = smoothstep(.3 + .35 * edgesWidth, 1. - .35 * edgesWidth + edge_blur, mixer);\n' +
        '    vec3 blended_color_2 = mix(color1, color2, r1); float blended_opacity_2 = mix(c1.a, c2.a, r1);\n' +
        '    vec3 c = mix(blended_color_2, color3, r2); float o = mix(blended_opacity_2, c3.a, r2);\n' +
        '    return vec4(c, o);\n' +
        '}\n' +
        'void main() {\n' +
        '    vec2 uv = gl_FragCoord.xy / u_resolution.xy;\n' +
        '    float t = .5 * u_time;\n' +
        '    float noise_scale = .0005 + .006 * u_scale;\n' +
        '    uv -= .5; uv *= (noise_scale * u_resolution); uv = rotate(uv, u_rotation * .5 * PI); uv /= u_pixelRatio; uv += .5;\n' +
        '    float n1 = noise(uv * 1. + t); float n2 = noise(uv * 2. - t);\n' +
        '    float angle = n1 * TWO_PI;\n' +
        '    uv.x += 4. * u_distortion * n2 * cos(angle); uv.y += 4. * u_distortion * n2 * sin(angle);\n' +
        '    float iterations_number = ceil(clamp(u_swirlIterations, 1., 30.));\n' +
        '    for (float i = 1.; i <= iterations_number; i++) {\n' +
        '        uv.x += clamp(u_swirl, 0., 2.) / i * cos(t + i * 1.5 * uv.y);\n' +
        '        uv.y += clamp(u_swirl, 0., 2.) / i * cos(t + i * 1. * uv.x);\n' +
        '    }\n' +
        '    float proportion = clamp(u_proportion, 0., 1.);\n' +
        '    float shape = 0.; float mixer = 0.;\n' +
        '    if (u_shape < .5) {\n' +
        '      vec2 su = uv * (.5 + 3.5 * u_shapeScale);\n' +
        '      shape = .5 + .5 * sin(su.x) * cos(su.y);\n' +
        '      mixer = shape + .48 * sign(proportion - .5) * pow(abs(proportion - .5), .5);\n' +
        '    } else if (u_shape < 1.5) {\n' +
        '      vec2 su = uv * (.25 + 3. * u_shapeScale); float f = fract(su.y);\n' +
        '      shape = smoothstep(.0, .55, f) * smoothstep(1., .45, f);\n' +
        '      mixer = shape + .48 * sign(proportion - .5) * pow(abs(proportion - .5), .5);\n' +
        '    } else {\n' +
        '      float sh = 1. - uv.y; sh -= .5; sh /= (noise_scale * u_resolution.y); sh += .5;\n' +
        '      float shape_scaling = .2 * (1. - u_shapeScale);\n' +
        '      shape = smoothstep(.45 - shape_scaling, .55 + shape_scaling, sh + .3 * (proportion - .5));\n' +
        '      mixer = shape;\n' +
        '    }\n' +
        '    vec4 color_mix = blend_colors(u_color1, u_color2, u_color3, mixer, 1. - clamp(u_softness, 0., 1.), .01 + .01 * u_scale);\n' +
        '    fragColor = vec4(color_mix.rgb, color_mix.a);\n' +
        '}';

    function compile(type, source) {
        var shader = gl.createShader(type);
        gl.shaderSource(shader, source);
        gl.compileShader(shader);
        return shader;
    }

    var vertexShader = compile(gl.VERTEX_SHADER, VERTEX_SHADER);
    var fragmentShader = compile(gl.FRAGMENT_SHADER, FRAGMENT_SHADER);

    var program = gl.createProgram();
    gl.attachShader(program, vertexShader);
    gl.attachShader(program, fragmentShader);
    gl.linkProgram(program);
    gl.useProgram(program);

    // Un rectangle (2 triangles) qui couvre tout l'ecran : le shader peint dessus.
    var positionBuffer = gl.createBuffer();
    gl.bindBuffer(gl.ARRAY_BUFFER, positionBuffer);
    gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([-1, -1, 1, -1, -1, 1, -1, 1, 1, -1, 1, 1]), gl.STATIC_DRAW);
    var positionLocation = gl.getAttribLocation(program, 'a_position');
    gl.enableVertexAttribArray(positionLocation);
    gl.vertexAttribPointer(positionLocation, 2, gl.FLOAT, false, 0, 0);

    // Emplacements des variables qu'on envoie au shader a chaque image (uniforms).
    var u = {
        time: gl.getUniformLocation(program, 'u_time'),
        resolution: gl.getUniformLocation(program, 'u_resolution'),
        pixelRatio: gl.getUniformLocation(program, 'u_pixelRatio'),
        scale: gl.getUniformLocation(program, 'u_scale'),
        rotation: gl.getUniformLocation(program, 'u_rotation'),
        color1: gl.getUniformLocation(program, 'u_color1'),
        color2: gl.getUniformLocation(program, 'u_color2'),
        color3: gl.getUniformLocation(program, 'u_color3'),
        proportion: gl.getUniformLocation(program, 'u_proportion'),
        softness: gl.getUniformLocation(program, 'u_softness'),
        shape: gl.getUniformLocation(program, 'u_shape'),
        shapeScale: gl.getUniformLocation(program, 'u_shapeScale'),
        distortion: gl.getUniformLocation(program, 'u_distortion'),
        swirl: gl.getUniformLocation(program, 'u_swirl'),
        swirlIterations: gl.getUniformLocation(program, 'u_swirlIterations'),
    };

    function resize() {
        var pixelRatio = Math.min(window.devicePixelRatio || 1, 2); // plafonne pour les ecrans tres haute def
        canvas.width = window.innerWidth * pixelRatio;
        canvas.height = window.innerHeight * pixelRatio;
        gl.viewport(0, 0, canvas.width, canvas.height);
    }
    resize();
    window.addEventListener('resize', resize);

    var startTime = performance.now();

    function frame(time) {
        var elapsed = (time - startTime) / 1000;
        var speed = (params.speed / 100) * 5;

        gl.uniform1f(u.time, elapsed * speed);
        gl.uniform2f(u.resolution, canvas.width, canvas.height);
        gl.uniform1f(u.pixelRatio, Math.min(window.devicePixelRatio || 1, 2));
        gl.uniform1f(u.scale, params.scale);
        gl.uniform1f(u.rotation, (params.rotation * Math.PI) / 180);
        gl.uniform4f(u.color1, params.color1[0], params.color1[1], params.color1[2], params.color1[3]);
        gl.uniform4f(u.color2, params.color2[0], params.color2[1], params.color2[2], params.color2[3]);
        gl.uniform4f(u.color3, params.color3[0], params.color3[1], params.color3[2], params.color3[3]);
        gl.uniform1f(u.proportion, params.proportion);
        gl.uniform1f(u.softness, params.softness);
        gl.uniform1f(u.shape, params.shape);
        gl.uniform1f(u.shapeScale, params.shapeSize);
        gl.uniform1f(u.distortion, params.distortion);
        gl.uniform1f(u.swirl, params.swirl);
        gl.uniform1f(u.swirlIterations, params.swirlIterations);

        gl.drawArrays(gl.TRIANGLES, 0, 6);
        requestAnimationFrame(frame);
    }
    requestAnimationFrame(frame);

    // Convertit un "#RRGGBB" en 4 nombres entre 0 et 1 (format attendu par le shader).
    function hexToRgba(hex) {
        var c = hex.replace('#', '');
        return [
            parseInt(c.substring(0, 2), 16) / 255,
            parseInt(c.substring(2, 4), 16) / 255,
            parseInt(c.substring(4, 6), 16) / 255,
            1,
        ];
    }
})();
