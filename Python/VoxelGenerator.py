import bpy
import os
imgName = "sphere.png";
pixels = bpy.data.images[imgName].pixels;
imgWidth = bpy.data.images[imgName].size[0];
imgHeight = bpy.data.images[imgName].size[1];
for i in range(0,len(pixels)//4):
    if(pixels[i*4+3]>0):
        materialString = "";
        materialString += str(round(pixels[i*4],2)) + ",";
        materialString += str(round(pixels[i*4+1],2)) + ",";
        materialString += str(round(pixels[i*4+2],2)) + ",";
        materialString += str(round(pixels[i*4+3],2));
        try:
            bpy.data.materials[materialString];
        except:
            bpy.data.materials.new(materialString);
            bpy.data.materials[materialString].diffuse_color[0] = round(pixels[i*4],2);
            bpy.data.materials[materialString].diffuse_color[1] = round(pixels[i*4+1],2);
            bpy.data.materials[materialString].diffuse_color[2] = round(pixels[i*4+2],2);
            bpy.data.materials[materialString].diffuse_intensity = 1;
            bpy.data.materials[materialString].specular_intensity = 0;
            if round(pixels[i*4+3],2) < 1:
                bpy.data.materials[materialString].use_transparency = True;
                bpy.data.materials[materialString].alpha = round(pixels[i*4+3],2);
        x = i%imgWidth;
        y = (i//imgWidth)%imgWidth;
        z = i//(imgWidth**2);
        newName = str(x) + "," + str(y) + "," + str(z);
        bpy.ops.mesh.primitive_cube_add(radius=.5);
        bpy.context.active_object.name = newName;
        bpy.data.objects[newName].active_material = bpy.data.materials[materialString];
        bpy.data.objects[newName].location[0] = x - imgWidth/2 + 0.5;
        bpy.data.objects[newName].location[1] = y - imgWidth/2 + 0.5;
        bpy.data.objects[newName].location[2] = z - imgHeight/imgWidth/2 + 0.5;